// Fuad Suleymanli

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

// container.classList.add("visible");
container.classList.add("sign-up-mode");

// sign_up_btn.style.transform = 'translateX(0) translateY(-50%)';

// sign_up_btn.addEventListener("click", () => {
//   container.classList.add("sign-up-mode");
// });

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// JavaScript
// const sign_in_btn = document.querySelector("#sign-in-btn");
// const sign_up_btn = document.querySelector("#sign-up-btn");
// const container = document.querySelector(".container");
// const signinForm = document.getElementById('signin-form');
// const signupForm = document.getElementById('signup-form');

// Tampilkan form "Sign Up" terlebih dahulu saat halaman pertama dimuat
// signinForm.style.transform = 'translateX(-100%) translateY(-50%)';
// signupForm.style.transform = 'translateX(0) translateY(-50%)';

// Tambahkan event listener ke form "Sign Up"
// signupForm.addEventListener("submit", function(event) {
  // event.preventDefault();
  
  // Lakukan posting data ke server (gantilah dengan logika posting data Anda)
  // Misalnya, menggunakan fetch API atau Ajax untuk mengirim data ke server
  // Setelah berhasil diposting, panggil fungsi untuk beralih ke form "Sign In"
  // Contoh asumsi data berhasil diposting dalam 2 detik
  // setTimeout(() => {
    // switchToSignIn();
  // }, 2000);
// });

// function switchToSignIn() {
  // Hapus kelas "sign-up-mode" saat beralih ke form "Sign In"
  // container.classList.remove("sign-up-mode");
// }