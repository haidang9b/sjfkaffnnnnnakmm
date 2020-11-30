function showDeleteClass(key,name){
    let nameDel = document.getElementById('nameClassDel');
    let keyDel = document.getElementById('key-delete');
    nameDel.innerHTML = name;
    keyDel.value= key;
}

function showEditClass(ten,mota, phanhoc, phonghoc, chude, codelop){
    let keyEdit = document.getElementById('key-edit');
    let txtTen = document.getElementById('name-class');
    let txtMota = document.getElementById('desc-class');
    let txtPhonghoc = document.getElementById('room-class');
    let txtPhanhoc = document.getElementById('part-class');
    let txtChude = document.getElementById('chude-class');

    keyEdit.value = codelop;
    txtChude.value = chude;
    txtTen.value = ten;
    txtMota.value = mota;
    txtPhanhoc.value = phanhoc;
    txtPhonghoc.value = phonghoc;

}