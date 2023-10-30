<section>

## out-of-the-box

### content

- [zonelets](https://zonelets.net/)

    a flat-file blogging engine designed for neocities, but can technically be used on any static site. requires javascript.

### style

- pre-made layouts
    - [nonkiru's layouts](https://nonkiru.art/layouts)
    - [sadgrl's layouts](https://sadgrl.online/webmastery/layouts/)

- [sadgrl's layout builder](https://sadgrl.online/projects/layout-builder/)

</section>

<section>

## templating languages & preprocessors

- [pug](https://github.com/pugjs/pug#syntax)

    pug uses whitespace and indentation instead of tags for rendering HTML. it has a few other features, such as includes, template inheritance, and markdown rendering.
    
    it is possible to skip `npm install` entirely and compile pug within vscode using the [compile hero](https://marketplace.visualstudio.com/items?itemName=Wscats.qf) extension. a [command line interface](https://github.com/pugjs/pug-cli) is also available.

    pug is also available for PHP as [phug](https://phug-lang.com/).

- [twig](https://twig.symfony.com/)

    a template engine for PHP, with syntax akin to [nunjucks](https://mozilla.github.io/nunjucks/) for javascript and [django](https://docs.djangoproject.com/en/4.2/topics/templates/) for python. also supports converting markdown to html and vice versa.

- [sass](https://sass-lang.com/)

    a CSS preprocessor - super useful for polyfilling nested styles and vendor prefixes for older browsers. sass variables are also much more flexible that regular CSS variables.
    
    sass can be precompiled with [compile hero](https://github.com/Wscats/compile-hero) or [live sass compiler](https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass) for vscode.

</section>
