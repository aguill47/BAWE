<footer class="site-footer">
  <div class="footer-grid">
    <div class="footer-col">
      <h4><?= ($lang==='fr') ? 'Contact' : 'Contact' ?></h4>
      <p><strong>Email</strong> :
        <a href="mailto:redpoppyproduction@gmail.com">redpoppyproduction@gmail.com</a>
      </p>
      <p><strong><?= ($lang==='fr') ? 'Téléphone' : 'Phone' ?></strong> :
        <a href="tel:+33673278371">06 73 27 83 71</a>
      </p>
    </div>

    <div class="footer-col">
      <h4><?= ($lang==='fr') ? 'Suivez-nous' : 'Follow us' ?></h4>
      <div class="social">
        <!-- Instagram -->
        <a class="social-btn ig" href="https://www.instagram.com/redpoppyproduction/"
           target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A5.5 5.5 0 1 1 6.5 13 5.5 5.5 0 0 1 12 7.5zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5zm5.75-2.25a1.25 1.25 0 1 1-1.25 1.25 1.25 1.25 0 0 1 1.25-1.25z"/>
          </svg>
          <span>Instagram</span>
        </a>

        <!-- Facebook -->
        <a class="social-btn fb" href="https://www.facebook.com/profile.php?id=100089766703919"
           target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M13.5 22v-8h2.7l.4-3H13.5V8.6c0-.9.3-1.5 1.7-1.5H17V4.3c-.3 0-1.4-.1-2.6-.1-2.6 0-4.4 1.6-4.4 4.5V11H7.5v3h2.5v8h3.5z"/>
          </svg>
          <span>Facebook</span>
        </a>
      </div>
    </div>
  </div>

  <p class="footer-note">
    <?= ($lang==='fr')
      ? '© ' . date('Y') . ' Red Poppy Production — Tous droits réservés.'
      : '© ' . date('Y') . ' Red Poppy Production — All rights reserved.'; ?>
  </p>
</footer>
