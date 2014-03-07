<div<?php print $attributes; ?>>
  <div id="header" class="l-constrained l-header" role="banner">
    <div id="logo">
      <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-branding__logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
        <?php endif; ?>
        <?php if ($site_name): ?>
          <a href="<?php print $front_page; ?>" class="site-branding__name" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <h2 class="site-branding__slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
    </div>
    <div id="extranavi">
      <ul>
        <li><a accesskey="A" class="aktuelles" title="Aktuelles (ALT+A)" href="https://inkota.de/aktuell/">Aktuelles</a></li>
        <li><a accesskey="M" class="mitmachen" title="Mitmachen (ALT+M)" href="https://inkota.de/mitmachen/">Mitmachen</a></li>
        <li><a accesskey="S" class="spenden" title="Spenden (ALT+S)" href="https://inkota.de/spenden/">Spenden</a></li>
      </ul>
    </div>
    <?php print render($page['navigation']); ?>
  </div>
  <?php if (!empty($page['highlighted'])): ?>
    <div class="l-highlighted-wrapper">
      <?php print render($page['highlighted']); ?>
    </div>
  <?php endif; ?>

  <div class="l-main l-constrained">
    <a id="main-content"></a>
    <?php print render($tabs); ?>
    <?php print $messages; ?>
    <?php print render($page['help']); ?>
    <?php if (!empty($page['neu'])): ?>
    <div class="neu">
      <?php print render($page['neu']); ?>
    <div>
  <?php endif; ?>
  <?php if (!empty($page['neu'])): ?>
    <div class="meistgekauft">
      <?php print render($page['meistgekauft']); ?>
    <div>
  <?php endif; ?>
    <div class="l-content" role="main">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <?php print render($page['sidebar_first']); ?>
    <?php print render($page['sidebar_second']); ?>
  </div>

  <footer class="l-footer-wrapper" role="contentinfo">
    <?php print render($page['footer']); ?>
  </footer>
</div>
