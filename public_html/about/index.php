<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once dirname(__DIR__,2).'/resources/includes/head.shtml'; ?>
    <title>about | jasmine's journal</title>
    <link rel="canonical" href="https://jasm1nii.xyz/about"/>
    <link href="/_assets/stylesheets/about.css" rel="stylesheet" type="text/css" media="all"/>
    <meta name="description" content="about the website (and the webmaster)"/>
</head>
<body>
    <div class="layout">
        <div>
            <header>
                <hgroup>
                    <h1><span id="h1-main">about jasmine</span>'s journal</h1>
                    <p class="site-update">
                        page contents updated <time datetime="2023-10-28">28 october 2023</time>
                    </p>
                </hgroup>
                <nav aria-label="primary">
                    <?php
                        $nav = new DOMDocument;
                        $nav->loadHTMLFile(dirname(__DIR__,2).'/resources/includes/headernav.shtml');
                        $about_index = $nav->getElementById('about');
                        $about_subindex = $nav->createElement('ul');
                        $about_index->appendChild($about_subindex);

                        $changelog_index = $nav->createElement('li');
                        $about_subindex->appendChild($changelog_index);
                        $changelog_a = $nav->createElement('a','changelog');
                        $changelog_a_href = $nav->createAttribute('href');
                        $changelog_a_href->value = '/about/changelog';
                        $changelog_a->appendChild($changelog_a_href);
                        $changelog_index->appendChild($changelog_a);

                        echo $nav->saveHTML();
                    ?>
                </nav>
            </header>
        </div>
        <div>
            <main>
                <article>
                    <section class="soundcloud">
                        <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/418439064&color=%23b686b9&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true" title="SoundCloud widget"></iframe>
                        <a href="https://soundcloud.com/ahiiiii" rel="external">ahiru</a> · <a href="https://soundcloud.com/ahiiiii/cherry-plum-album" rel="external">Cherry Plum (Album)</a>
                    </section>
                    <section>
                        <h2>the website</h2>
                        <section>
                            <h3 id="owo">what's this?</h3>
                            <p>
                                <b>welcome to my digital sandbox!</b>
                            </p>
                            <p>
                                "jasmine's journal" was created as a personal project in july 2023. its inception was mainly driven by a desire to reclaim my online presence, as well as my growing discontent with modern social media.
                            </p> 
                            <p>
                                by extension, this website also serves as an experimental canvas to sharpen my coding skills. it is coded entirely by hand - an initially daunting task as someone who's never opened a real code editor until one month prior. nevertheless, i'm proud to say that i've learned a lot since then!
                            </p>
                            <p>
                                with that in mind, i intend to use this space to showcase whatever i want, however i want - whether that be personal interests, my thoughts on various subjects, or stuff i've worked on.
                            </p>
                        </section>
                        <section>
                            <h3>site updates</h3>
                            <p>
                                a detailed list of past edits and planned additions can be viewed on the <strong><a href="/about/changelog">change log page</a></strong>.
                            </p>
                        </section>

                        <section>
                            <h3>facts for nerds</h3>
                            <ul>
                                <li>
                                    coded with <a href="https://vscodium.com/" rel="external"><strong>vscodium</strong></a>.
                                </li>
                                <li>
                                    sometimes i use <b>raw <abbr title="HyperText Markup Language">HTML</abbr></b> for writing my site content, other times i use <b>markdown</b> with <b><a href="https://twig.symfony.com/" rel="external">twig for <abbr title="PHP: HyperText Preprocessor">PHP</abbr></a></b>. most of the styling is done with <b><a href="https://sass-lang.com/"><abbr title="Sassy Cascading Style Sheets">SCSS</abbr></a></b>. and of course, i add the shinier client-side features with <b>javascript</b>.
                                    <figure id="languages">
                                        <a href="https://github.com/anuraghazra/github-readme-stats" rel="external"><img src="https://top-languages-jasmines-journal.vercel.app/api/top-langs/?username=jasm1nii&theme=synthwave&layout=donut&text_color=ffffff&hide_border=true&line_height=1000&hide_title=true" width="350" height="215" alt="top languages in this site's code base"/></a>
                                        <figcaption>most used languages</figcaption>
                                    </figure>
                                </li>
                                <li>
                                    includes various <strong><a href="/credits.html">assets and code libraries</a></strong> graciously provided by many wonderful people on the internet.
                                </li>
                                <li>
                                    tested for viewing on the following operating systems, with the latest version of these browsers:
                                    <ul>
                                        <li>
                                            <b>windows 10 22H2</b> and <b>android 13:</b> firefox and chrome
                                        </li>
                                        <li>
                                            <b>iPadOS 17:</b> safari
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    emits <strong><a href="https://www.websitecarbon.com/website/jasm1nii-xyz/" rel="external">88% less <abbr title="carbon dioxide">CO<sub>2</sub></abbr></strong> than other websites</a>.
                                </li>
                            </ul>
                        </section>

                    </section>
                    <section>
                        <h2>the webmaster</h2>
                        <section>
                            <h3>my background</h3>
                            <section>
                                <h4>how i got started with coding</h4>
                                <p>
                                    i first dipped my toes in front-end design as an elementary student toying with <a href="https://en.wikipedia.org/wiki/Multiply_(website)" rel="external">multiply</a> blog layouts - back when i was <em>definitely</em> too young to be on the internet.
                                </p>
                                <p>
                                    toying around in their onsite code editor was a favorite pastime for me, up until the service shut down in the early 2010s. afterwards, i didn't code for <em>years</em>, as the newer, more popular "social" networks didn't allow for customization to that extent*, and the notion of self-hosting a site never really came to mind.
                                <p>
                                    it wasn't until i caught wind of sites like <a href="https://cohost.org/" rel="external">cohost</a>, <a href="https://spacehey.com/" rel="external">spacehey</a>, and <a href="https://neocities.org/" rel="external">neocities</a> in my early 20s, when i rediscovered the joy of creative coding and carving out your own space online. through the independent web revival, i was finally re-incentivized to brush up on my "lost skills"... so, here i am!
                                    <br/>
                                    <span aria-hidden="true" class="emoji">૮ ˶ᵔ ᵕ ᵔ˶ ა</span>
                                </p>
                                <hr>
                                <p>
                                    while i don't have a formal education in web development, my sense of layouting and aesthetics is largely influenced by my undergraduate background in visual communication design with a concentration in multimedia.
                                </p>
                                <p>
                                    by experience, i'm <em>much</em> more accustomed to outputting non-interactive visual work, such as illustrations, graphic designs, and motion art - but i hope to show more of that here as this site comes together! <span aria-hidden="true">&#10023;</span>
                                </p>
                                <footer>
                                    * save for tumblr, but it never really caught on for some reason...
                                </footer>
                        </section>
                        </section>

                        <section class="section-style-2">
                            <details open>
                                <summary>more facts</summary>
                                <div>
                                    <p>
                                        <ul>
                                            <li>i am muslim by faith ☪</li>
                                            <li>i was raised in the united states until the age of thirteen.</li>
                                            <li>my personality typology is INFP-T 4w5*.</li>
                                            <li>i'm a <em>huge</em> perfume fan - been loving their music since their "<a href="https://youtu.be/rBX5YGPNDbs?si=_do_yfgFGN3eXTMf">dream fighter</a>" era!</li>
                                            <li>purple is my favorite color <small>(i hope that's obvious)</small> 💜</li>
                                            <li>i'm a late-diagnosed neurodivergent with AuDHD &infin;</li>
                                            <li>i took piano lessons as a kid and played clarinet in my junior high band. i still play music occassionally in my free time, but i wish i could do it more often...</li>
                                            <li>i think "sonic rush" is the best game in the franchise, and i will not be convinced otherwise.</li>
                                        </ul>
                                        <sub>
                                            * i'm aware that <a href="https://en.wikipedia.org/wiki/Myers%E2%80%93Briggs_Type_Indicator#Criticism" rel="external">MBTI and similar typologies have their problems</a> - i just think they're fun to explore!
                                        </sub>
                                    </p>
                                </div>
                            </details>
                        </section>

                        <section id="contact">
                            <details open>
                                <summary>contact</summary>
                                <dl>
                                    <dt>email</dt>
                                    <dd>
                                        domain address: <a href="mailto:contact@jasm1nii.xyz" rel="me">contact@jasm1nii.xyz</a> | <a href="https://jasm1nii.xyz/assets/pgp-public-jasm1nii-xyz.asc">download PGP key</a>
                                    </dd>
                                    <dd>
                                        proton address: <a href="mailto:jasmine.postcard685@slmail.me">jasmine.postcard685@slmail.me</a>
                                    </dd>
                                </dl>
                                <p>
                                    use the associated <abbr title="Pretty Good Privacy">PGP</abbr> key (<a href="https://www.maketecheasier.com/pgp-encryption-how-it-works/" rel="external">?</a>) if you need to send an encrypted message from a non-proton email. my public key is also available via <a href="https://keys.openpgp.org/" rel="external">keys.openpgp.org</a>.
                                </p>
                                <dl>
                                    <dt>instant messengers</dt>
                                    <dd>
                                        feel free to ask me about them via email.
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>my other profiles</dt>
                                    <div class="data-columns">
                                        <dd>
                                            <a href="https://mas.to/@jasm1nii" rel="external me">mastodon</a>
                                        </dd>
                                        <dd>
                                            <a href="https://cohost.org/" rel="external me">cohost</a>
                                        </dd>
                                        <dd>
                                            <a href="https://spacehey.com/jasm1nii" rel="external me">spacehey</a>
                                        </dd>
                                        <dd>
                                            <a href="https://www.instagram.com/jasm1nii.art/" rel="external me">art instagram</a>
                                        </dd>
                                        <dd>
                                            <a href="https://neocities.org/site/jasm1nii" rel="external me">neocities</a>
                                        </dd>
                                        <dd>
                                            <a href="https://github.com/jasm1nii" rel="external me">github</a>
                                        </dd>
                                    </div>
                                </dl>
                            </details>
                        </section>
                    </section>
                </article>
            </main>
            <footer>
                <?php include dirname(__DIR__,2).'/resources/includes/footer.shtml';?>
            </footer>
        </div>
    </div>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
</body>
</html>