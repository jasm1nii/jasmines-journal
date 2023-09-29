document.getElementById("vocaring").innerHTML = `
<style>
@import url('https://fonts.googleapis.com/css2?family=Tektur&display=swap');
.vocacontainer::selection {
    background: #34f2ff;
    color:white;
}
.vocacontainer::-moz-selection {
    background: #34f2ff;
    color:white;
}
.vocacontainer{
    height: 200px;
    padding:10px 10px 0px 10px;
}
#vocaring {
    width: 150px;
    margin: 10px auto;
    background-color: #dbfcff !important;
    border: 2px solid #34f2ff;
}
#vocaring a:hover {
    background-color: turquoise;
}
#vocaring .webring-info {
    text-align: center;
    font-family: 'Tektur', cursive;
    color: #b300b3 !important;
    font-size:20px;
    background-color: transparent !important;
}
#vocaring .webring-links {
    font-size: .9em;
    font-family: 'Tektur', cursive;
    text-transform: lowercase;
    color:#ac3973 !important;
    background-color: transparent !important;
}
#vocaring .webring-links a {
    text-decoration: none;
    color: #66449C !important;
    transition: 0.3s;
}
#vocaring .webring-links a:hover {
    letter-spacing: normal;
}
img {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    margin-top: 1em;
}
</style>
<div class='vocacontainer'>
    <span class='webring-info'>VOCALOID WEBRING</span>
    <br>
    <span class='webring-links'><a href='https://webring.adilene.net/'>Index</a> · <a href='https://webring.adilene.net/members.php'>Members</a></span>
    <img src='/assets/media/main/vocaloid.png' width="100" height="100" alt="" loading="lazy"/>
</div>
`;