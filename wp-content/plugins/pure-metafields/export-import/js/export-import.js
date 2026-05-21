/**
 * Export / Import — JS
 */
(function ($) {
	'use strict';
	if (typeof PFExportImport === 'undefined') return;

	var counts  = PFExportImport.counts || {};
	var pending = null; // JSON data staged for import

	$(function () {
		// Populate counts
		Object.keys(counts).forEach(function (key) {
			$('#ei-count-' + key).text(counts[key]);
		});

		wireExport();
		wireImport();
	});

	/* ── Export ────────────────────────────────────────────────────────── */
	function wireExport() {
		$(document).on('click', '.ei-export-btn', function () {
			var type = $(this).data('type');
			var $btn = $(this).prop('disabled', true).text('Exporting…');

			$.post(PFExportImport.ajaxUrl, {
				action: 'pf_export',
				nonce:  PFExportImport.nonce,
				types:  type,
			}, function (res) {
				$btn.prop('disabled', false).html('<span class="dashicons dashicons-download"></span> Export' + (type === 'all' ? ' All' : ''));
				if (res.success) {
					downloadJson(res.data, 'pure-fields-' + type + '-' + datestamp() + '.json');
				} else {
					alert('Export failed.');
				}
			});
		});
	}

	/* ── Import ────────────────────────────────────────────────────────── */
	function wireImport() {
		// File picker
		$('#ei-file-input').on('change', function () {
			var file = this.files[0];
			if (file) handleFile(file);
		});

		// Drag and drop
		var $dz = $('#ei-dropzone');
		$dz.on('dragover', function (e) { e.preventDefault(); $dz.addClass('is-over'); });
		$dz.on('dragleave', function () { $dz.removeClass('is-over'); });
		$dz.on('drop', function (e) {
			e.preventDefault();
			$dz.removeClass('is-over');
			var file = e.originalEvent.dataTransfer.files[0];
			if (file) handleFile(file);
		});

		// Confirm
		$(document).on('click', '#ei-import-confirm', function () {
			if (!pending) return;
			var $btn = $(this).prop('disabled', true).text('Importing…');
			$.post(PFExportImport.ajaxUrl, {
				action: 'pf_import',
				nonce:  PFExportImport.nonce,
				data:   JSON.stringify(pending),
			}, function (res) {
				$btn.prop('disabled', false).html('<span class="dashicons dashicons-yes-alt"></span> Confirm Import');
				if (res.success) {
					showImportResult(res.data.imported, res.data.failed);
				} else {
					alert('Import failed: ' + (res.data || 'unknown error'));
				}
			});
		});
	}

	function handleFile(file) {
		$('#ei-file-name').text(file.name).show();
		var reader = new FileReader();
		reader.onload = function (e) {
			try {
				var data = JSON.parse(e.target.result);
				pending = data;
				showPreview(data);
			} catch (err) {
				alert('Invalid JSON file: ' + err.message);
			}
		};
		reader.readAsText(file);
	}

	function showPreview(data) {
		var parts = [];
		if (data.metafields  && data.metafields.length)  parts.push(data.metafields.length  + ' metabox(es)');
		if (data.post_types  && data.post_types.length)  parts.push(data.post_types.length  + ' post type(s)');
		if (data.taxonomies  && data.taxonomies.length)  parts.push(data.taxonomies.length  + ' taxonomy/ies');
		if (data.options     && data.options.length)     parts.push(data.options.length     + ' option panel(s)');

		if (!parts.length) {
			$('#ei-preview-notice').html('<span class="dashicons dashicons-warning"></span> No recognizable data found in this file.');
			$('#ei-import-preview').show();
			$('#ei-import-confirm').hide();
			return;
		}

		$('#ei-preview-notice').html(
			'<span class="dashicons dashicons-info-outline"></span> '
			+ 'Ready to import: <strong>' + parts.join(', ') + '</strong>. '
			+ (data._exported ? 'Exported: ' + data._exported + '.' : '')
		);
		$('#ei-import-confirm').show();
		$('#ei-import-preview').show();
		$('#ei-import-result').hide();
	}

	function showImportResult(imported, failed) {
		imported = imported || {};
		failed   = failed   || {};

		// Show every section the file contained (even when count is 0), so the
		// user can see at a glance if any section silently dropped to zero.
		var labels = {
			metafields: 'metabox(es)',
			post_types: 'post type(s)',
			taxonomies: 'taxonomy/ies',
			options:    'option panel(s)'
		};
		var parts = [];
		Object.keys(labels).forEach(function (key) {
			if (pending && pending[key] && pending[key].length) {
				parts.push((imported[key] || 0) + ' ' + labels[key]);
			}
		});

		var failTotal = (failed.metafields || 0) + (failed.post_types || 0)
			+ (failed.taxonomies || 0) + (failed.options || 0);
		var failParts = [];
		Object.keys(labels).forEach(function (key) {
			if (failed[key]) failParts.push(failed[key] + ' ' + labels[key]);
		});

		var noticeClass = failTotal ? 'pf-notice--warning' : 'pf-notice--success';
		var icon        = failTotal ? 'dashicons-warning' : 'dashicons-yes-alt';
		var headline    = failTotal ? 'Import finished with issues.' : 'Import successful!';
		var html = '<div class="pf-notice ' + noticeClass + '">'
			+ '<span class="dashicons ' + icon + '"></span>'
			+ '<strong>' + headline + '</strong> Imported: ' + (parts.join(', ') || 'nothing') + '.';
		if (failTotal) {
			html += ' Failed: ' + failParts.join(', ') + '.';
		}
		html += '</div>';

		$('#ei-import-result').html(html).show();
		$('#ei-import-preview').hide();
		pending = null;
	}

	/* ── Helpers ───────────────────────────────────────────────────────── */
	function downloadJson(data, filename) {
		var blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
		var url  = URL.createObjectURL(blob);
		var a    = document.createElement('a');
		a.href     = url;
		a.download = filename;
		a.style.display = 'none';
		document.body.appendChild(a);
		a.click();
		// Revoke after the browser has queued the download navigation.
		requestAnimationFrame(function () {
			document.body.removeChild(a);
			URL.revokeObjectURL(url);
		});
	}

	function datestamp() {
		var d = new Date();
		return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
	}

	function pad(n) { return n < 10 ? '0' + n : n; }

}(jQuery));
