<?php $img_root = '/_assets/media/main';?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once dirname(__DIR__,1).'/resources/includes/head.shtml'; ?>
    <title>jasmine's journal</title>
    <link rel="canonical" href="https://jasm1nii.xyz/"/>
    <meta name="description" content="the interwebbed dwelling of a multifaceted internet creative"/>
    <meta property="og:description" content="the interwebbed dwelling of a multifaceted internet creative"/>

    <link rel="preload" href="<?=$img_root?>/07042023-me_compressed.webp" as="image" type="image/webp" fetchpriority="high"/>
    <link rel="preload" href="<?=$img_root?>/pluto-pretzel_compressed.webp" as="image" type="image/webp"/>
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
            <h1>jasmine's journal <img class="ascii-img" src="<?=$img_root?>/index-h1-after.svg" width="300" height="50" alt=""/></h1>
            <p><img class="ascii-img" src="<?=$img_root?>/index-subtitle-before.svg" width="40" height="30" alt=""/> a space for my digital miscellany</p>
            <noscript>
              <p>(javascript is disabled - some site elements may be non-interactive, missing and/or out of date)</p>
            </noscript>
          </hgroup>
        </div>
        <nav aria-label="primary">
          <?php include_once dirname(__DIR__,1).'/resources/includes/headernav.shtml'; ?>
        </nav>
        <div class="notice-group" aria-label="notice">
          <button id="pin" aria-expanded="true">📌</button>
          <div id="notice"></div>
        </div>
      </header>

      <main>
        <article>
          <div class="page-columns">
            <section aria-labelledby="webmaster-identity">
              <div class="card h-card">
                <h2 id="webmaster-identity">webmaster identity</h2>
                <div class="pfp-group">
                  <img class="u-photo" src="<?=$img_root?>/07042023-me_compressed.webp" width="190" height="190" alt="a self portrait of the webmaster"/>
                  <div class="flower-fill">
                    <img src="<?=$img_root?>/flower.svg" width="50" height="50" alt=""/>
                    <img src="<?=$img_root?>/flower.svg" width="50" height="50" alt=""/>
                    <div id="surprise">
                      <noscript>
                        <details>
                          <summary>
                            <img src="<?=$img_root?>/flower.svg" width="50" height="50" alt="" title="open for a surprise!"/>
                          </summary>
                          <img src="<?=$img_root?>/la-creatura.png" loading="lazy" class="u-featured" alt="ASCII art of the autism creature"/>
                        </details>
                      </noscript>
                    </div>
                  </div>
                </div>
                <div class="p-note">
                  <p>
                    just call me <span class="p-name p-given-name"><b>jasmine</b></span>!
                  </p>
                  <ul>
                    <li><span role="img" aria-label="location">📍</span> <span class="p-country-name">indonesia</span></li>
                    <li><span role="img" aria-label="birthday">🎂</span> <span class="dt-bday">1999</span></li>
                    <li><span role="img" aria-label="occupation">🎨</span> <span class="p-category">illustrator & multimedia designer</span></li>
                  </ul>
                  <div class="hidden">
                    <a class="u-url" href="acct:jasmine@jasm1nii.xyz" aria-hidden="true" tabindex="-1" inert></a>
                    <a rel="me" href="/about" aria-hidden="true" tabindex="-1" inert>jasmine</a>
                    <a rel="me" href="https://fed.brid.gy/r/https://jasm1nii.xyz/" aria-hidden="true" tabindex="-1" inert></a>
                    <span class="u-url u-uid" aria-hidden="true" tabindex="-1">
                      <a href="https://jasm1nii.xyz/" aria-hidden="true" tabindex="-1" inert></a>
                    </span>
                  </div>
                </div>
                <div class="barcode"></div>
              </div>
            </section>

            <section aria-labelledby="note-to-visitors">
              <div class="card">
                <h2 id="note-to-visitors"><span aria-hidden="true">📝</span> note to visitors</h2>
                <p>
                  this is <strong>not</strong> intended to be a professional site.
                </p>
                <p>
                  if you're interested in viewing something more refined, you can take a look at my <a href="https://jasmineamalia.com/" rel="external me">portfolio page</a> - but it's still a work in progress.
                </p>
              </div>
            </section>

            <section aria-labelledby="current-time">
              <div class="time">
                <p id="current-time">
                  current time in<br><span class="p-locality">bandung, indonesia</span>
                </p>
                <div class="clock-display">
                  <p class="clock" timezone="+7"></p>
                </div>
                <p>
                  timezone: GMT+7
                </p>
              </div>
            </section>

            <section aria-labelledby="last-played">
              <div class="card last-played">
                <div id="track">
                  <h2 id="last-played"><span aria-hidden="true">🎵</span> last played</h2>
                  <p id="song" data-animation>&#8987;</p>
                </div>
                <div class="last-played-child">
                  <button type="button" id="js-toggle" title="pause scroll animation" aria-label="pause scroll animation" aria-controls="song" aria-pressed="false">⏯</button>
                  <a href="https://www.last.fm/user/jasm1nii" id="last-fm-profile" rel="external me" class="button-style">last.fm profile</a>
                </div>
              </div>
            </section>
            
            <section aria-labelledby="latest-status">
              <div class="card latest-status">
                <h2 id="latest-status"><span aria-hidden="true">☕</span> latest status</h2>
                <div id="statuscafe">
                  <div id="statuscafe-username"></div>
                  <div id="statuscafe-content"></div>
                  <div>
                    <a href="https://status.cafe" rel="external">
                      <img src="<?=$img_root?>/statuscafebutton.png" width="88" height="31" alt="Status Cafe" loading="lazy" fetchpriority="low"/>
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <section aria-labelledby="site-updates">
              <div class="card">
                <h2 id="site-updates"><span aria-hidden="true">🆕</span> site updates</h2>
                <div class="overflow">
                  <h3><time datetime="2023-10-25">25 october 2023</time></h3>
                  <ul>
                    <li>huge overhaul of the backend - rewrote a lot of code in PHP and twig!</li>
                  </ul>
                  <h3><time datetime="2023-10-11">12 october 2023</time></h3>
                  <ul>
                    <li>published my <a href="/accessibility">accessibility statement!</a></li>
                  </ul>
                  <h3><time datetime="2023-10-11">11 october 2023</time></h3>
                  <ul>
                    <li>
                      <strong>dark mode</strong> is now available on all pages!!
                    </li>
                  </ul>
                  <footer>
                    more details and past changes can be found in the <a href="/about/changelog">change log.</a>
                  </footer>
                </div>
              </div>

            </section>
            <section aria-labelledby="tip-jar">
              <div class="card">
                <h2 id="tip-jar"><span aria-hidden="true">💕</span> tip jar</h2>
                <ul>
                  <li>
                    <a href="https://ko-fi.com/jasmineamalia" id="ko-fi" title="ko-fi" rel="external" class="button-style"><span aria-hidden="true">💲</span> support with USD</a>
                  </li>
                  <li>
                    <a href="https://trakteer.id/jasmineamalia" id="trakteer" title="trakteer" rel="external" class="button-style"><span aria-hidden="true">🇮🇩</span> support with IDR</a>
                  </li>
                </ul>
              </div>
            </section>
            
            <section aria-labelledby="web-rings">
              <div class="card web-rings">
                <h2 id="web-rings"><span aria-hidden="true">🕸</span> web rings & listings</h2>
                <details>
                  <summary>
                    what's a web ring?
                  </summary>
                  <p>
                    <a href="https://en.wikipedia.org/wiki/Webring" rel="external"><dfn>web rings</dfn></a> (or webrings) are groups of interconnected websites - each with a specific theme - that links its members together in an endless loop. click the navigational arrows to go to the next site! <small>&hellip; and the next one! <small>&hellip; and the next one after that! <small>&hellip; it just keeps going!</small></small></small>
                  </p>
                </details>
                <section class="web-rings-list">
                  <section aria-labelledby="pending-web-rings">
                    <h3 id="pending-web-rings">pending</h3>
                    <p>
                      <a href="https://loop.graycot.dev/webring.html?action=prev" aria-label="loop ring: previous site" rel="external">←</a><a href="https://loop.graycot.dev/webring.html?action=home" rel="external">loop ring</a><a href="https://loop.graycot.dev/webring.html?action=next" aria-label="loop ring: next site" rel="external">→</a>
                      <br/>
                      <a href="https://loop.graycot.dev/webring.html?action=rand" rel="external" aria-label="loop ring: random site"><small>random</small></a> <span aria-hidden="true">|</span>
                      <a href="https://loop.graycot.dev/webring.html?action=list" rel="external" aria-label="loop ring: member list"><small>member list</small></a>
                    </p>
                  </section>
                  <section aria-labelledby="joined-web-rings">
                    <h3 id="joined-web-rings">joined</h3>
                    <div id="resourceRing"></div>
                    <p>
                      <a href="https://indieseek.xyz/" rel="external"><img src="<?=$img_root?>/indieseek.gif" alt="indieseek.xyz directory" width="88" height="31" loading="lazy"/></a>
                    </p>
                    <p>
                      <a href="https://pinkvampyr.leprd.space/accessiblenet/" rel="external"><img src="<?=$img_root?>/accessiblenet88x31.png" alt="accessible net directory" width="88" height="31" loading="lazy"/></a>
                    </p>
                    <p>
                      <a href="https://xn--sr8hvo.ws/previous" rel="external" aria-label="indieweb ring: previous site">←</a> <a href="https://xn--sr8hvo.ws" rel="external">indieweb ring</a> <a href="https://xn--sr8hvo.ws/next" rel="external" aria-label="indieweb ring: next site">→</a>
                    </p>
                    <p>
                      <a href="https://pastels.minty.nu/" rel="external"><img src="<?=$img_root?>/100x50-mallows.gif" width="100" height="50" alt="pastel colours fanlisting" loading="lazy"/></a>
                    </p>
                    <ring-900 site="https://jasm1nii.xyz/"></ring-900>
                    <p>
                      <a href="https://fediring.net/previous?host=jasm1nii.xyz" rel="external" aria-label="fediring: previous site">←</a>
                      <a href="https://fediring.net/" rel="external">fediring</a>
                      <a href="https://fediring.net/next?host=jasm1nii.xyz" rel="external" aria-label="fediring: next site">→</a>
                      <br>
                      <a href="https://fediring.net/random" rel="external" aria-label="fediring: random site"><small>random</small></a>
                    </p>
                    <p>
                      <a href="https://macaque.moe/trickyfox/" rel="external" aria-label="linked clique">LINKED!</a> <img src="<?=$img_root?>/linked.png" width="20" height="20" alt="" loading="lazy"/> blaze the cat
                    </p>
                    <p>
                      <img src="<?=$img_root?>/angelic-left.png" width="20" height="20" alt="" loading="lazy"/><span class="string">i am<a href="https://macaque.moe/trickyfox/" rel="external">angelic <span aria-hidden="true">♥</span></a></span> <img src="<?=$img_root?>/angelic-right.png" width="20" height="20" alt="" loading="lazy"/>
                    </p>
                    <p>
                      <a href="https://kalechips.net/responsive/index" rel="external"><img src="<?=$img_root?>/responsive-website-directory.png" width="88" height="31" alt="responsive website directory" loading="lazy"/></a>
                    </p>
                    <p>
                      <a href="https://smoothsailing.asclaria.org/" rel="external"><img src="<?=$img_root?>/smooth-sailing.png" width="88" height="31" alt="smooth sailing listings" loading="lazy"/></a>
                    </p>
                    <p id="healinghospital"></p>
                    <p id="autiring"></p>
                    <p>
                      <a href="http://pkmn.caelestis.nu" rel="external noopener noreferrer" title="I Choose You!"><img src="<?=$img_root?>/piplup.png" alt="piplup" width="56" height="42" loading="lazy"/></a>
                    </p>
                    <p>
                      <a href="https://melanated.neocities.org/" rel="external"><img src="<?=$img_root?>/melanated.png" width="80" height="15" alt="melanated: POC webmaster listing" loading="lazy"/></a>
                    </p>
                    <p id="vocaring">
                      <span class="title">VOCALOID WEBRING</span>
                      <br/>
                      <span>
                        <a href='https://webring.adilene.net/' rel="external" aria-label="vocaloid webring: index">index</a> <span aria-hidden="true">|</span> <a href='https://webring.adilene.net/members.php' rel="external" aria-label="vocaloid webring: members">members</a>
                      </span>
                      <br/>
                      <img src='<?=$img_root?>/vocaloid.png' width="100" height="100" alt="" loading="lazy"/>
                    </p>
                    <p>
                      <a href="https://hotlinewebring.club/jasm1nii/previous" rel="external" aria-label="hotline webring: previous site">←</a><a href="https://hotlinewebring.club/" rel="external">hotline webring</a><a href="https://hotlinewebring.club/jasm1nii/next" rel="external" aria-label="hotline webring: next site">→</a>
                    </p>
                  </section>
                </section>
              </div>
            </section>
          </div>
        </article>
      </main>
    </div>

    <footer>
      <?php include dirname(__DIR__,1).'/resources/includes/footer.shtml';?>
    </footer>

    <script defer src="index.js"></script>
    <script defer src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
  
</html>