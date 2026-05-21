/**
 * Pure Fields — Welcome page JS
 *
 * 1. Fixes WP admin parent overflow so position:sticky works on the nav.
 * 2. Runs IntersectionObserver scroll-reveal on .pfw-animate elements.
 * 3. Handles the video play button.
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		fixAdminOverflow();
		initScrollReveal();
		initVideo();
		highlightActiveNavLink();
	});

	/* ── Fix WP admin parent overflow ──────────────────────────────────────
	 * WordPress sets overflow:hidden on #wpwrap which prevents position:sticky
	 * from working anywhere on the page. We reset it only while this page is
	 * active (JS is only enqueued on this specific hook).
	 * ----------------------------------------------------------------------- */
	function fixAdminOverflow() {
		[ 'wpwrap', 'wpbody', 'wpbody-content', 'wpcontent' ].forEach(function (id) {
			var el = document.getElementById(id);
			if (el) {
				el.style.overflow = 'visible';
				// Do NOT set overflowX separately: mixing overflow-x:hidden with
				// overflow-y:visible forces overflow-y to auto, creating scroll
				// containers that break position:sticky.
			}
		});
	}

	/* ── Scroll-triggered entrance animations ──────────────────────────────── */
	function initScrollReveal() {
		var items = document.querySelectorAll('.pfw-animate');
		if (!items.length) return;

		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						io.unobserve(entry.target);
					}
				});
			}, { threshold: 0.08, rootMargin: '0px 0px -32px 0px' });
			items.forEach(function (el) { io.observe(el); });
		} else {
			items.forEach(function (el) { el.classList.add('is-visible'); });
		}
	}

	/* ── Video play button ─────────────────────────────────────────────────── */
	function initVideo() {
		var playBtn = document.getElementById('pfw-play-btn');
		var thumb   = document.getElementById('pfw-video-thumb');
		var iframe  = document.getElementById('pfw-video-iframe');
		if (!playBtn || !iframe) return;

		playBtn.addEventListener('click', function () {
			var src = iframe.dataset.src || '';
			// Guard: need a real YouTube video ID in data-src
			if (!src || src.indexOf('youtube.com/embed/') === -1 ||
				(!src.replace('?autoplay=1','').trim()) ||
				(src.indexOf('?autoplay') !== -1 && !src.replace('?autoplay=1','').trim())) {
				showNoVideoMsg();
				return;
			}
			iframe.src = src;
			iframe.style.display = 'block';
			if (thumb) { thumb.style.opacity = '0'; thumb.style.pointerEvents = 'none'; }
			playBtn.style.display = 'none';
		});
	}

	function showNoVideoMsg() {
		var frame = document.getElementById('pfw-video-frame');
		if (!frame) return;
		var msg = document.createElement('div');
		msg.style.cssText = 'position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;'
			+ 'justify-content:center;gap:10px;background:rgba(244,246,251,.96);color:#64748b;font-size:13px;z-index:5;border-radius:14px;';
		msg.innerHTML = '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">'
			+ '<rect x="2" y="6" width="20" height="14" rx="2"/><path d="M8 2l4 4 4-4"/></svg>'
			+ '<span>Set the YouTube URL in admin/templates/welcome.php → data-src</span>';
		frame.appendChild(msg);
		setTimeout(function () {
			msg.style.transition = 'opacity .4s';
			msg.style.opacity    = '0';
			setTimeout(function () { msg.remove(); }, 400);
		}, 3000);
	}

	/* ── Highlight current nav link ─────────────────────────────────────────── */
	function highlightActiveNavLink() {
		var links = document.querySelectorAll('.pfw-nav-link');
		var page  = new URLSearchParams(window.location.search).get('page') || '';
		links.forEach(function (link) {
			var href = link.getAttribute('href') || '';
			if (page && href.indexOf('page=' + page) !== -1) {
				link.style.color      = '#3362FF';
				link.style.background = '#f0f4ff';
				link.style.fontWeight = '700';
			}
		});
	}

}());
