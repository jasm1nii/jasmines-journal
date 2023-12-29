<section>

<h2>table of contents</h2>

[TOC]

</section>

<section>

## static sites only

*at most*, these sites only support HTML, javascript, and CSS. if you're looking to use PHP, node.js, python, and more, jump to [# static and dynamic sites.](/resources/webdev/site-hosts#static-and-dynamic-sites)

### low code

many of these feature a visual editor, which means they are relatively easy to use without any prior coding knowledge!

#### [mmm.page 👑](https://build.mmm.page/)

host location
:   north america

pricing
:   free and paid (5-30 USD per month)

storage limit
:   starts from 5 pages

monthly bandwidth
:   - free - 1,000 visitors per month
    - paid - 1,000-100,000 visitors per month

notes
:   - does not support exporting websites as files nor social discovery (yet).

    - custom <abbr title="HyperText Markup Language">HTML</abbr> is only supported on the paid plan.


#### [hotglue](https://hotglue.me/)

host location
:   netherlands

pricing
:   100% free

storage limit
:   no limit defined

monthly bandwidth
:   no limit defined

notes
:   - sites are discoverable via feed.

    - includes a forum for community discussion and troubleshooting.


#### [carrd 🎀](https://try.carrd.co/k8hrjrws)

host location
:   united states

pricing
:   free and paid (9-49 USD per year)

storage limit
:   - free - 100 elements, with 2 MB per image and 4 MB per video.
    - paid - no element limit, with 16 MB per image and 32 MB per video.

monthly bandwidth
:   no limit defined

notes
:   - geared towards single-page sites.

    - site editor is mobile-friendly!

    - projects can only be exported on the highest paid tier.


#### [tilda](https://tilda.cc/)

host location
:   united states

pricing
:   free and paid (15-25 USD per month)

total sites
:   - free - 1 site
    - paid - 5 sites

storage limit
:   - free - 50 pages & 50 MB total per site
    - paid - 500 pages & 1 GB total per site

monthly bandwidth
:   no limit defined

notes
:   - sites can be exported.

    - allows custom domains on all plans!



#### [webflow](https://webflow.com/)

host location
:   united states

pricing
:   free and paid (14-39 USD per month)

storage limit
:   - free - 2 pages & 50 content items.
    - paid - 150 pages & 0-10,000 content items.

monthly bandwidth
:   - free - 1 GB & 1,000 visitors.
    - paid - 50-400 GB & 250,000-300,000 visitors.

notes
:   custom domains are only available on a paid plan.

#### [webstudio 👑](https://webstudio.is/)

host location
:   north america

pricing
:   free and paid (20 USD per month)

storage limit
:   - free - 2 GB
    - paid - 20 GB

monthly bandwidth
:   - free - 10,000 page views
    - paid - 100,000 page views

notes
:   - the open-source alternative to webflow, with much higher hosting limits!

    - supports management via CLI and deployment to [vercel.](#vercel)


### more code

you'll need to brush up on your frontend programming skills and work directly with raw lines of code - check out [# coding-help](/resources/webdev#coding-help) over at [/resources/webdev](/resources/webdev) if you don't know where to start.


#### [ichi](https://ichi.city/)

host location
:   united kingdom

pricing
:   100% free

total sites
:   1 per account

storage limit
:   10 MB

monthly bandwidth
:   no limit defined

notes
:   - no email required for account creation - on the downside, this also means that lost passwords aren't recoverable.

    - all sites are discoverable via global feed, but there aren't any social interaction features.

    - supports site management via direct upload and <abbr title="secure file transfer protocol">SFTP</abbr>.

    - no custom domain options.


#### [neocities](https://neocities.org/)

host location
:   united states

pricing
:   free and paid (5 USD per month)

total sites
:   - free - 1 site
    - paid - unlimited sites

storage limit
:   - free - 1 GB
    - paid - 50 GB

monthly bandwidth
:   - free - 200 GB
    - paid - 3 TB

notes
:   - while i can vouch for the vibrant community, the spam filter is known to be overly sensitive - i've been the subject of [temporary suspension](https://jasm1nii.xyz/blog/articles/2023/8/17/entry), myself.

    - custom domains are only available on the paid plan.

    - social profiles are optional.

    - supports site management via direct upload, command line, and <abbr title="application programming interface">API</abbr>.


#### [github pages](https://pages.github.com/)

host location
:   united states

pricing
:   100% free for non-enterprise

storage limit
:   1 GB

monthly bandwidth
:   100 GB

notes
:   - site files are hosted in a public git repository.

    - supports adding custom domains at no extra cost.

    - more details on [github hosting limits here.](https://docs.github.com/en/pages/getting-started-with-github-pages/about-github-pages#limits-on-use-of-github-pages)


</section>

<section>

## static and dynamic sites

### building and hosting

#### [w3schools spaces](https://www.w3schools.com/spaces/index.php)

host location
:   united states

pricing
:   free and paid (5-30 USD per month)

storage limit
:   - free - 20 MB
    - paid - up to 15 GB

monthly bandwidth
:   - free - 500 requests & 25 MB served
    - paid - up to 10 million requests & 400 GB served

dynamic programming
:   - free - not available
    - paid - node.js, PHP, python, java, C#, and rust

database
:   unavailable

web server
:   not configurable

notes
:   learn as you go with one of the web's most popular tutorial sites! static pages are completely free, but backend support starts at 10 USD per month.


#### [glitch 👑](https://glitch.com/)

host location
:   united states

pricing
:   free and paid (8 USD per month)

storage limit
:   no limit defined

monthly bandwidth
:   no limit defined

dynamic programming
:   node.js

database
:   SQlite

web server
:   not configurable

notes
:   - beginner-friendly community with lots of remixable templates!

    - site repositories are public by default, but can be made private by upgrading to a paid plan.


### hosting only

#### [netlify](https://www.netlify.com/)

host location
:   - operations - united states
    - content delivery - globally distributed

pricing
:   free and paid (19 USD per month)

total sites
:   500 sites

storage limit
:   none defined

monthly bandwidth
:   - free - 100 GB
    - paid - 1 TB

dynamic programming
:   various javascript frameworks (as a build integration and for serverless functions only)

database
:   multiple options (for serverless functions only)

web server
:   not configurable

notes
:   supports uploading static sites as files without git.

#### [vercel](https://vercel.com/)

host location
:   - operations - united states
    - content delivery - globally distributed

pricing
:   free and paid (20 USD per month)

total sites
:   - free - 50 sites
    - paid - unlimited sites

storage limit
:   none defined

monthly bandwidth
:   - free - 100 GB
    - paid - 1 TB

dynamic programming
:   35+ javascript, python, and [PHP](https://github.com/vercel-community/php) frameworks (as a build integration and for serverless functions only)

database
:   multiple options, including vercel KV and postgres (for serverless functions only)

web server
:   not configurable

notes
:   - only supports site management via CLI and third-party git services.

    - beware that you might be blocked upon signup if you use an account that's not associated with a gmail address (source: personal experience, also [corroborated by others](https://github.com/vercel/next.js/discussions/33365)). this can quickly be resolved by emailing support.


#### [render](https://render.com/)

host location
:   - operations - united states
    - content delivery - global distribution for static sites, [4 regions for dynamic sites](https://docs.render.com/regions)

pricing
:   free and paid (19-29 USD per month)

storage limit
:   - static sites: virtually free
    - dynamic sites: 0.25 USD/GB per month, if a persistent disk is required (e.g. anything mySQL-based)

monthly bandwidth
:   starts from 100 GB

dynamic programming
:   - natively supports node.js, python, ruby, go, rust, and elixir
    - other languages require additional setup with [docker](https://www.docker.com/)

database
:   natively supports postgresSQL and redis

web server
:   not configurable

notes
:   \-


#### [teacake 👑](https://teacake.org/)

host location
:   united states

pricing
:   free and paid (2-3 USD per month)

storage limit
:   - free - 500 MB
    - paid - up to 5 GB

monthly bandwidth
:   - free - 5 GB
    - paid - up to 30 GB

dynamic programming
:   PHP

database
:   mySQL

web server
:   apache

notes
:   GUI admin panel for site management is only available with a paid plan.


#### [leprd 👑](https://leprd.space/)

host location
:   north america

pricing
:   100% free

storage limit
:   up to 5 GB

monthly bandwidth
:   up to 50 GB

dynamic programming
:   PHP

database
:   mySQL (mariaDB)

web server
:   apache

notes
:   - while their offerings exceed those of teacake, available slots tend to be more limited.

    - GUI admin panel is available on all plans.


#### [marigold town](https://marigold.town/)

host location
:   united states

pricing
:   100% free

storage limit
:   2 GB

monthly bandwidth
:   150 GB

dynamic programming
:   PHP, java

database
:   mySQL

web server
:   apache

notes
:   - themed as a cozy town square!

    - signup is also limited to a few accounts at a time.


#### [infinity free](https://www.infinityfree.com/)

host location
:   united states

pricing
:   100% free

storage limit
:   5 GB

monthly bandwidth
:   unlimited

dynamic programming
:   PHP

database
:   mySQL (mariaDB)

web server
:   apache

notes
:   - a well-established hosting service for starter sites.

    - provides help via community forums, but does not offer 1-on-1 support.


#### [uberspace 💲](https://uberspace.de/en/)

host location
:   germany

pricing
:   5-15 EUR per month

storage limit
:   10-100 GB

dynamic programming
:   PHP, python, ruby, .NET core, and node.js

database
:   mySQL

web server
:   apache

notes
:   - runs on renewable energy!

    - requires a willingness to get comfortable with the command line.


#### [nearly free speech 💲](https://www.nearlyfreespeech.net/)

host location
:   united states

pricing
:   starts from 0.01 USD per month

storage limit
: 1 USD/GB per month

dynamic programming
:   [25+ languages](https://2023q3.nfshost.com/)

database
:   mySQL (mariaDB)

web server
:   apache

notes
:   - also requires some command line know-how.

    - does not offer webmail hosting.

</section>
