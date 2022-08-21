document.querySelector("#check1").addEventListener("change", function(){
    var fragment = document.createDocumentFragment();
    fragment.appendChild(document.getElementById('#check1'));
    document.getElementById('destination').appendChild(fragment);
})