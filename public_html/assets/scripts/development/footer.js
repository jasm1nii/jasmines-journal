document.querySelector("#footer").innerHTML =`
<p>
    site analytics powered by <a href="https://www.goatcounter.com/">goat counter</a>
</p>
<ul>
    <li id="footerCopyright">
        <time>2023</time> - until hell freezes over
    </li>
    <li id="footerAccessibility">
        <a href="/accessibility.html">accessibility</a>
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
<div style="display: inline-flex; align-items: center;">
    <a href="https://nonbot.org/pledged/view/9a37b04c-c60a-41a4-81ee-e8e04110bdf3" rel="external">
        <img src="/assets/media/main/nonbot_pledged_logo.svg" alt="human-made content" height="50" width="50" loading="lazy">
    </a>
    <a href="https://indieweb.org/" rel="external" style="margin-left: 10px; margin-right: 15px;">
        <img src="/assets/media/main/indieweb-badge.png" width="80" height="15" alt="part of the indie web" style="image-rendering:pixelated;" loading="lazy">
    </a>
    <a href="https://indieweb.org/Webmention" rel="external">
        <img src="/assets/media/main/webmention-button.png" width="80" height="15" alt="supports webmentions" style="image-rendering:pixelated;" loading="lazy">
    </a>
</div>
<style>
    footer a img { text-decoration: none }
</style>
`;