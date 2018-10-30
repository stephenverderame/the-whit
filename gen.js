document.body.innerHTML = '<div top><p id="tbStart"><span arial tb l="new">Test Page</span><span arial tb l="upload">Upload</span><span arial tb l="prof">Artist Profiles</span></div><div id="heady" header></p><span id="ht" l="index" big arial>The Whit<span></div>' + document.body.innerHTML;
document.body.innerHTML += '<div bottom><div id="bBar"><span bt big arial>test</span><span bt big arial>text</span><span bt big arial>here</span></div><div>';
var gen;
document.querySelectorAll('[l]').forEach(function(i){
    gen = i.getAttribute('l').split('~');
    i.setAttribute('onclick', 'ftb("'+gen[0]+(gen.length > 1 ? '", "'+gen[1] : '')+'")');
});
function ftb(data, m=false){
    window.location = data+".html"+(m ? "?"+m : "");
}
document.querySelectorAll('[words]').forEach(function(i){
    gen = i.innerHTML.length;
    i.style.fontSize = "xx-large";
});
//FFc01
document.querySelectorAll('tr').forEach(function(i){
    i.setAttribute('arial', "");
    i.setAttribute('big', "");
    i.setAttribute('words', "");
});
