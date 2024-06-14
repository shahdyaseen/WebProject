function gotoHoodies(){
    document.getElementById("hoodies").style.display="flex";
    document.getElementById("hoodiesActive").className="activeSec";
    document.getElementById("mugsActive").className="noActiveSec";
    document.getElementById("bagsActive").className="noActiveSec";
    document.getElementById("mugs").style.display="none";
    document.getElementById("bags").style.display="none";
}
function gotoMugs(){
    document.getElementById("hoodies").style.display="none";
    document.getElementById("mugs").style.display="flex";
    document.getElementById("mugsActive").className="activeSec";
    document.getElementById("bagsActive").className="noActiveSec";
    document.getElementById("hoodiesActive").className="noActiveSec";
    document.getElementById("bags").style.display="none";
}
function gotoBags(){
    document.getElementById("hoodies").style.display="none";
    document.getElementById("mugs").style.display="none";
    document.getElementById("bags").style.display="flex";
    document.getElementById("bagsActive").className="activeSec";
    document.getElementById("mugsActive").className="noActiveSec";
    document.getElementById("hoodiesActive").className="noActiveSec";

}