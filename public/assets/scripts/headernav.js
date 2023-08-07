document.getElementById("headernav").innerHTML =`
<ul>
    <li><a href="index.html">home</a></li>
    <li><a href="about.html">about</a></li>
    <li>🔨 <del>blog</del></li>
    <li>🔨 <del>shrines</del></li>
    <li>🔨 <del>art</del></li>
    <li>🔨 <del>resources</del></li>
    <li><a rel="me external" href="https://jasm1nii.123guestbook.com/">guestbook</a></li>
    <li><a href="neocities-network.html">neocities network</a></li>
</ul>
<style>
@media all and (max-width:768px) {
    #headernav {
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: thin;
        }
}
</style>
`;