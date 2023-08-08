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
    background-color: #dbfcff;
    border:3px solid #34f2ff;
}
#vocaring a:hover {
    background-color: turquoise;
}

#vocaring table {
    margin: 0 auto;
}

#vocaring .webring-info {
    text-align:center;
    font-family: 'Tektur', cursive;
    color:#e74492;
    font-size:20px;
}

#vocaring .webring-links{
    font-size: .9em;
    font-family: 'Tektur', cursive;
    text-transform: lowercase;
    color:#e74492;
}

#vocaring .webring-links a{
    text-decoration: none;
    color:#e74492;
    text-shadow: 2px 2px 1px #34f2ff;
    transition:0.3s;
}

#vocaring .webring-links a:hover{
    
    letter-spacing: normal;
}

img {
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>

    <table class='vocacontainer' style='text-align: center;'>
    <tr>
        <td>
            <div class='webring-info'>VOCALOID WEBRING</div>
            <div class='webring-links'>
                <a href='https://webring.adilene.net/' target='_parent'>Index</a> · <a href='https://webring.adilene.net/members.php' target='_parent'>Members</a> 
            </div>
        </td>
    </tr>
    <tr>
        <td style='text-align:center;'><img src='https://adilene.net/webring/images/vocaloid.png'></td>
    </tr>
  </table>
`;