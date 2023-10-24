<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once dirname(__DIR__,1).'/resources/includes/head.shtml'; ?>
        <title>accessibility | jasmine's journal</title>
        <link rel="canonical" href="https://jasm1nii.xyz/accessibility"/>
        <meta name="description" content="accessibility statement for the website"/>
        <meta property="og:description" content="accessibility statement for the website"/>
        <link href="/_assets/stylesheets/content_B1.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
        <header>
            <hgroup>
                <h1>jasmine's journal</h1>
                <p>page contents updated <time datetime="2023-10-12">12 october 2023</time></p>
            </hgroup>
            <nav>
                <?php include_once dirname(__DIR__,1).'/resources/includes/headernav.shtml'; ?>
            </nav>
        </header>
        <main>
            <article>
                <section>
                    <h2>accessibility</h2>
                    <p>
                        i try my best to ensure that my website is accesible to a wide range of people, so this site is designed with the following in mind:
                    </p>
                    <section>
                        <h3>navigability</h3>
                        <ul>
                            <li>content is semantically ordered and marked up for interpretation by assistive technology and interaction via other means of input, such as text-to-speech applications and keyboards.</li>
                        </ul>
                    </section>
                    <section>
                        <h3>responsiveness</h3>
                        <ul>
                            <li>layout is mobile-friendly.</li>
                            <li>when zoomed in up to 200%, elements should resize appropriately, and lines should wrap where expected.</li>
                        </ul>
                    </section>
                    <section>
                        <h3>contextual clarity</h3>
                        <ul>
                            <li>non-decorative images provide alternative text for screen reader users.</li>
                        </ul>
                    </section>
                    <section>
                        <h3>visual clarity</h3>
                        <ul>
                            <li>non-decorative text satisfies the minimum contrast ratio of 4.5:1 for compliance with <abbr>WCAG</abbr> <a href="https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html" rel="external">(<cite>web content accessibility guidelines</cite>)</a> level AA.</li>
                            <li>reader mode should be available where applicable, but due to inconsistent implementation by browsers, this feature is not guaranteed.</li>
                        </ul>
                    </section>
                    <section>
                        <h3>photosensitivity</h3>
                        <ul>
                            <li>if present, animated content should have static alternatives.</li>
                        </ul>
                    </section>
                    <section>
                        <h3>content stability</h3>
                        <ul>
                            <li><a href="https://web.dev/articles/cls" rel="external">unexpected layout shift</a> should be as minimal as possible.</li>
                        </ul>
                    </section>
                    <section>
                        <h3><a href="https://developer.mozilla.org/en-US/docs/Glossary/Graceful_degradation" rel="external">graceful degradablity</a></h3>
                        <ul>
                            <li>with the exception of certain features that absolutely require it (such as webmentions and comments), alternatives means of displaying or linking to important content should be provided if javascript is disabled.
                                <ul>
                                    <li>color scheme preferences only utilize javascript for access via toggle button. if disabled, they will follow the user's preset device theme.</li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                    <hr/>
                    <p>
                        native site elements should conform to all of the above. however, iframes from external sources may vary in their adherance.
                    </p>
                </section>
            </article>
        </main>
        <footer>
            <?php include dirname(__DIR__,1).'/resources/includes/footer.shtml';?>
        </footer>
        <script src="/_assets/scripts/theme-switcher-v2.js"></script>
    </body>
</html>