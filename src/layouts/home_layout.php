<?php
  class Media {
    const Img = "/_assets/media/main";
  }

  class Card {
    const Src = SITE_ROOT . Template::Content . "home/_card_";
    public static function About() {
      include self::Src . "about.php";
    }
    public static function Note() {
      include self::Src . "note.php";
    }
    public static function Clock() {
      include self::Src . "clock.php";
    }
    public static function LastFM() {
      include self::Src . "lastfm.php";
    }
    public static function Status() {
      include self::Src . "status.php";
    }
    public static function SiteUpdates() {
      $page = Template::Content . "home/_card_site-updates.html.twig";
      View::RenderTwig($page, null);
    }
    public static function TipJar() {
      include self::Src . "tip-jar.php";
    }
    public static function WebRings() {
      include self::Src . "webrings.php";
    }
    public static function Guestbook() {
      include self::Src . "guestbook.php";
    }
  }
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Includes::Head()?>
    <title>jasmine's journal</title>
    <link rel="canonical" href="https://jasm1nii.xyz/"/>
    <meta name="description" content="the interwebbed dwelling of a multifaceted internet creative"/>
    <meta property="og:description" content="the interwebbed dwelling of a multifaceted internet creative"/>

    <link rel="preload" href="<?=Media::Img?>/07042023-me_compressed.webp" as="image" type="image/webp" fetchpriority="high"/>
    <link rel="preload" href="<?=Media::Img?>/pluto-pretzel_compressed.webp" as="image" type="image/webp"/>
    <link rel="preload" href="/_assets/fonts/Besley/Besley-VariableFont_wght.woff2" as="font" type="font/woff2" crossorigin/>
    <link rel="preload" href="/_assets/fonts/Instrument_Sans/InstrumentSans-VariableFont_wdth-wght.woff2" as="font" type="font/woff2" crossorigin/>
    <link rel="preload" href="/_assets/fonts/Inconsolata/Inconsolata-VariableFont_wdth-wght.woff2" as="font" type="font/woff2" crossorigin/>
    <link rel="stylesheet" href="/_assets/stylesheets/home.css" type="text/css" media="all"/>
    <noscript>
      <link rel="stylesheet" href="/_assets/stylesheets/home_noscript.css" type="text/css" media="all"/>
    </noscript>

    <link href="https://jasm1nii.xyz/_assets/pgp-public-jasm1nii-xyz.asc" rel="authn pgpkey"/>
    <link href="mailto:contact@jasm1nii.xyz" rel="authn me"/>
    <link rel="authorization_endpoint" href="https://indieauth.com/auth"/>
    <link rel="token_endpoint" href="https://tokens.indieauth.com/token"/>
  </head>
  <body>
    <div class="board">
      <header>
        <div class="top">
          <hgroup>
            <h1>
              jasmine's journal <img class="ascii-img" src="<?=Media::Img?>/index-h1-after.svg" width="300" height="50" alt=""/>
            </h1>
            <p>
              <img class="ascii-img" src="<?=Media::Img?>/index-subtitle-before.svg" width="40" height="30" alt=""/> a space for my digital miscellany
            </p>
            <noscript>
              <p>
                (javascript is disabled - some site elements may be non-interactive, missing and/or out of date)
              </p>
            </noscript>
          </hgroup>
        </div>
        <nav aria-label="primary">
          <?=Includes::HeaderNav()?>
        </nav>
      </header>
      <main>
        <aside>
          <div class="notice-group" aria-label="notice">
            <button id="pin" aria-expanded="true">📌</button>
            <div id="notice"></div>
          </div>
        </aside>
        <article>
          <div class="page-columns">
            <?=Card::About()?>
            <?=Card::Note()?>
            <?=Card::Clock()?>
            <?=Card::LastFM()?>
            <?=Card::Status()?>
            <?=Card::SiteUpdates()?>
            <?=Card::TipJar()?>
            <?=Card::WebRings()?>
            <?=Card::Guestbook()?>
          </div>
        </article>
      </main>
    </div>

    <footer>
      <?=Includes::Footer()?>
    </footer>

    <script defer src="/_assets/scripts/home/index.js"></script>
    <script defer src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
  
</html>