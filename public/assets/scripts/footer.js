document.querySelector("#footer").innerHTML =`
<p>
    site analytics powered by <a href="https://www.goatcounter.com/">goat counter</a>
</p>

<ul>
    <li><time>2023</time> - until hell freezes over</li>
    <li><a href="/about#contact">contact</a></li>
    <li><a href="/site-map.html">site map</a></li>
    <li><a href="/credits.html">credits</a></li>
    <li>🔨 <del>accessibility</del></li>
    <li>hosted by <a href="https://www.rumahweb.com/" rel="sponsored">rumahweb</a></li>
    <li>
        <a href="https://indieweb.org/">
        <img src="/assets/media/main/indieweb-badge.png" width="80" height="15" alt="part of the indie web" style="image-rendering:pixelated;"></a>
    </li>
    <li>
        <a href="https://indieweb.org/Webmention">
        <img src="/assets/media/main/webmention-button.png" width="80" height="15" alt="supports webmentions" style="image-rendering:pixelated;"></a>
    </li>
</ul>
<style>
    footer ul li:has(img) a {
        text-decoration: none;
    }
</style>
`;