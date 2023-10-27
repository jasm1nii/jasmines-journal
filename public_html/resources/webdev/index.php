<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once dirname(__DIR__,3).'/resources/includes/head.shtml'; ?>
    <title>jasmine's resources</title>
    <link href="/_assets/stylesheets/content_A2.css" rel="stylesheet" type="text/css" media="all"/>
    <meta name="description" content="a catalogue of helpful things for web design, art, and more!"/>
  </head>
  <body>
    <div id="layout">
        <header>
            <hgroup>
                <h1>jasmine's resources</h1>
                <p>
                    page contents updated
                    <time datetime="2023-09-10">10 september 2023</time>
                </p>
            </hgroup>
            <nav>
                <?php include_once dirname(__DIR__,3).'/resources/includes/headernav.shtml'; ?>
            </nav>
        </header>
        <main>
            <article>
                <section>
                    <h2>web development</h2>
                    <section>
                        <h3>getting started</h3>
                            <section>
                                <h4><a href="site-hosts.html">site hosting services</a></h4>
                            </section>
                            <section>
                                <h4>site templates</h4>
                                <section>
                                    <dl>
                                        <dt>pre-made layouts</dt>
                                        <dd>
                                            <ul>
                                                <li>by <a href="https://nonkiru.art/layouts">nonkiru</a></li>
                                                <li>by <a href="https://sadgrl.online/webmastery/layouts/">sadgrl</a></li>
                                            </ul>
                                        </dd>
                                        <dt>
                                            <a href="https://sadgrl.online/projects/layout-builder/">sadgrl's layout builder</a>
                                        </dt>
                                    </dl>
                                </section>
                            </section>
                            <section>
                                <h4>coding tutorials</h4>
                                <section>
                                    <p>
                                        if you're a complete beginner to coding static websites, i recommend looking through <a href="https://neocities.org/tutorials">this list by neocities</a> first.
                                    </p>
                                    <details>
                                        <summary>what are static websites?</summary>
                                        <p>
                                            <dfn>static sites</dfn> are made with client-side languages, such as HTML, CSS, and javascript, and they display the same content to every user. in general, their contents can only be changed by editing each individual page, unlike <i><a href="https://blog.hubspot.com/website/static-vs-dynamic-website" rel="external">dynamic sites</a></i>.
                                        </p>
                                    </details>
                                    <p>
                                        for learning how to work with <a href="https://code.visualstudio.com/">visual studio code</a> - one of the most popular code editors for desktop* - you can also check out <a href="https://bechnokid.neocities.org/resources/tut_vscode">this tutorial by bechno kid</a>.
                                    </p>
                                    <p>
                                        * there is also a <a href="https://vscode.dev/">web version</a> - no downloading required.
                                    </p>
                                </section>
                            </section>
                            <section>
                                <h4>code editing programs</h4>
                                <dl>
                                    <dt>alternatives to visual studio code</dt>
                                    <dd>
                                        <ul>
                                            <li><a href="https://brackets.io/">brackets</a></li>
                                            <li><a href="https://phcode.dev/">phoenix</a></li>
                                            <li><a href="https://webmaker.app/">webmaker</a></li>
                                            <li><a href="https://vscodium.com/">vscodium</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                            </section>
                            <section>
                                <h4>code editor extensions</h4>
                                <dl>
                                    <dt><a href="https://prettier.io/">prettier</a></dt>
                                    <dd>
                                        <p>
                                            a tool for making your code look super clean! also available as a VS code extension
                                        </p>
                                    </dd>
                                    <dt><a href="https://marketplace.visualstudio.com/items?itemName=tonybaloney.vscode-pets">VS code pets</a> 👑</dt>
                                    <dd>
                                        <p>🐈🐕🐓🐢🤖📎</p>
                                    </dd>
                                </dl>
                            </section>
                            <section>
                                <h4>accessibility references</h4>
                                <dl>
                                    <dt><a href="https://theultimatemotherfuckingwebsite.com/" rel="external">the ultimate *** website</a></dt>
                                    <dd>
                                        <p>
                                            i actually found this site from <a href="https://fri11s.neocities.org/blog/accessibility/" rel="external">fri11s' accessibility master post</a>!
                                        </p>
                                    </dd>
                                    <dt><a href="https://wave.webaim.org/" rel="external">WAVE</a> - web accessibility evaluation tool</dt>
                                    <dt><a href="https://www.deque.com/axe/browser-extensions/" rel="external">axe browser extensions</a> by deque</dt>
                                </dl>
                            </section>
                    </section>

                    <section>
                        <h3>code libraries</h3>
                        <p>
                            for a list of things that i've used specifically on this site (including graphics), refer to the <a href="../../credits.html">credits page</a>. more UI assets can be found on the <a href="../art-design.html">"art & design" resources page</a>. 
                        </p>
                        <section>
                            <h4>HTML & javascript</h4>
                            <section>
                                <dl>
                                    <dt><a href="https://www.maxlaumeister.com/pagecrypt/">page crypt</a> 👑</dt>
                                    <dd>password protect your static HTML files - great for restricting access to private pages!</dd>
                                    <dt><a href="https://zonelets.net/">zonelets</a></dt>
                                    <dd>a blogging engine designed for neocities, but can technically be used on any static site</dd>
                                    <dt><a href="https://github.com/Graycot/Oring">oring</a></dt>
                                    <dd>open source web ring template</dd>
                                    <dt><a href="https://github.com/MaxLaumeister/collectibles.js">collectibles.js</a></dt>
                                    <dd>add an item collection game to your website!</dd>
                                </dl>
                            </section>
                        </section>

                        <section>
                            <h4>CSS</h4>
                            <section>
                                <dl>
                                    <dt><a href="https://uiverse.io/">UI verse</a></dt>
                                    <dd>2.7k+ open source CSS elements</dd>
                                    <dt><a href="https://neumorphism.io/">neumorphism CSS generator</a></dt>
                                    <dd>
                                        need i say more? unless you're unfamiliar with the style - in that case, <a href="https://neumorphism.io/">read more here</a>.
                                    </dd>
                                    <dt><a href="https://animate.style/">animate.css</a></dt>
                                    <dd>
                                        a pure CSS library of predefined animations - takes the work out of setting keyframes for simple transitions
                                    </dd>
                                </dl>
                            </section>
                        </section>

                    </section>

                    <section>
                        <h3>other site tools</h3>
                        <section>
                            <dl>
                                <dt><a href="https://matthiasott.com/notes/good-riddance-gptbot">how to deter chatGPT from scraping your site</a> 👑</dt>
                                <dt><b>guestbooks and comment boxes</b></dt>
                                <dd>
                                    <details>
                                        <summary>expand section (5 entries)</summary>
                                        <p>
                                            <ul>
                                                <li><a href="https://virtualobserver.moe/ayano/comment-widget">ayano's neocities comment widget</a> - requires google forms, but is fully customizable as far as i know.</li>
                                                <li><a href="https://www.htmlcommentbox.com/">HTML comment box</a> - one of the more stylish options out of the box; most elements can be customized, but branding is not removable for free users.</li>
                                                <li><a href="https://cactus.chat/">cactus comments</a> - open source comment box with <a href="https://matrix.org/">matrix</a> account integration (required); can be used with SSGs.</li>
                                                <li><a href="https://www.123guestbook.com/">123guestbook</a> - very limited customization options, but at least there's a cute scroller widget lol. note that the guestbook itself is <em>not</em> mobile friendly.
                                                    <br><br>
                                                    i don't know to what extent the other providers have this, but 123guestbook also has IP blocking, email collection, inbox notifications, custom input fields, as well as manual comment approval.
                                                </li>
                                                <li><a href="https://disqus.com/">disqus</a> - many features in the UI, but the styling is not customizable at all. needs the plus plan to remove advertisements.</li>
                                            </ul>
                                        </p>
                                    </details>
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <a href="https://github.com/marketplace/actions/deploy-to-neocities">deploy-to-neocities github action</a>
                                </dt>
                                <dt>
                                    <a href="https://indiewebify.me/">indiewebify.me</a>
                                </dt>
                                <dd>
                                    <p>
                                        a technical in-depth guide to better integrating your site with the <a href="https://indieweb.org/">indie web</a> - includes a microformats validator
                                    </p>
                                </dd>
                                <dt>
                                    <a href="https://github.com/getindiekit/indiekit">indiekit</a>
                                </dt>
                                <dd>
                                    <p>
                                        publish content to static sites via your own node.js web server - can be integrated with a <abbr>SSG</abbr> (static site generator)
                                    </p>
                                </dd>
                            </dl>
                        </section>
                    </section>

                    <section>
                        <h3>more resources</h3>
                        <section>
                            <dl>
                                <dt><a href="https://makerpad.zapier.com/">makerpad</a></dt>
                                <dd>
                                    <details>
                                        <summary>
                                            tutorials and tools for building web apps with minimal coding knowledge
                                        </summary>
                                        <p>
                                            the language is more geared towards your typical silicon valley entrepeneur™ and anyone looking to build things that upscale, but i've personally referenced these for integrating automation into larger projects that involve teams, especially those that deal with community outreach.
                                        </p>
                                    </details>
                                </dd>
                                <dt><a href="https://32bit.cafe/">32-bit cafe</a> 👑</dt>
                                <dd>
                                    a community of personal web enthusiasts - they also run a <a href="https://32bit.cafe/discord/">discord server</a>! <b>18+ only, SFW</b>
                                    <br><br>
                                    <a href="https://32bit.cafe/discord/" rel="external"><img src="/_assets/media/resources/32b-win9x.png" alt="32-bit cafe button"></a>
                                </dd>
                                <dt><a href="https://tinytools.directory/">tiny tools</a></dt>
                                <dd>
                                    a massive list of free tools for any interactive project
                                </dd>
                                <dt><a href="https://github.com/goabstract/Awesome-Design-Tools">awesome design tools</a> on github</dt>
                            </dl>
                        </section>
                    </section>

                </section>
            </article>
        </main>
    </div>
    <footer>
        <?php include dirname(__DIR__,3).'/resources/includes/footer.shtml';?>
    </footer>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
</html>
