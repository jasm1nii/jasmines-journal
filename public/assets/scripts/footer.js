document.querySelector("#footer").innerHTML =`
<p>
    site analytics powered by <a href="https://www.goatcounter.com/">goat counter</a>
</p>

<ul>
    <li id="footerCopyright">
        <time>2023</time> - until hell freezes over
    </li>
    <li id="footerIndieweb">
        <a href="https://indieweb.org/">
        <img src="/assets/media/main/indieweb-badge.png" width="80" height="15" alt="part of the indie web" style="image-rendering:pixelated;"></a>
    </li>
    <li id="footerWebmentions">
        <a href="https://indieweb.org/Webmention">
        <img src="/assets/media/main/webmention-button.png" width="80" height="15" alt="supports webmentions" style="image-rendering:pixelated;"></a>
    </li>
    <li id="footerAcccessibility">
        🔨 <del>accessibility</del>
    </li>
    
    <li id="footerSitemap">
        <a href="/site-map.html">site map</a>
    </li>
    <li id="footerCredits">
        <a href="/credits.html">credits</a>
    </li>
    <li id="footerContact">
        <a href="/about#contact">contact</a>
    </li>
</ul>
<style>
    footer ul li:has(img) a {
        text-decoration: none;
    }
</style>
`;