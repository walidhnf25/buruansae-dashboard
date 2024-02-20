const btn1 = document.querySelector('.btn1');
const btn2 = document.querySelector('.btn2');
const btn3 = document.querySelector('.btn3');
const btn4 = document.querySelector('.btn4');
const btn5 = document.querySelector('.btn5');
const btn6 = document.querySelector('.btn6');
const btn7 = document.querySelector('.btn7');
const btn8 = document.querySelector('.btn8');

const tab1 = document.querySelector('#table-sayur');
const tab2 = document.querySelector('#table-tanamanObat');
const tab3 = document.querySelector('#table-ternak');
const tab4 = document.querySelector('#table-ikan');
const tab5 = document.querySelector('#table-buah');
const tab6 = document.querySelector('#table-olahanHasil');
const tab7 = document.querySelector('#table-sampah');
const tab8 = document.querySelector('#table-pembibitan');

btn1.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab-active');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn2.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab-active');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn3.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab-active');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn4.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab-active');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn5.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab-active');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn6.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab-active');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab');
});
btn7.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab-active');
  tab8.setAttribute('class', 'tab');
});
btn8.addEventListener('click', function () {
  tab1.setAttribute('class', 'tab');
  tab2.setAttribute('class', 'tab');
  tab3.setAttribute('class', 'tab');
  tab4.setAttribute('class', 'tab');
  tab5.setAttribute('class', 'tab');
  tab6.setAttribute('class', 'tab');
  tab7.setAttribute('class', 'tab');
  tab8.setAttribute('class', 'tab-active');
});
function previewImg() {
  const gambar = document.querySelector('#gambar');
  const imgPreview = document.querySelectorAll('.img-preview');

  const fileGambar = new FileReader();
  fileGambar.readAsDataURL(gambar.files[0]);

  fileGambar.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}
