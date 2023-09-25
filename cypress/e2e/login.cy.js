describe('Login Page', () => {
  beforeEach(() => {
    cy.visit('http://127.0.0.1:8000/')
  });

  it('displays username, password, remember inputs', () => {
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=password]').should('exist')
    cy.get('input[name=remember]').should('exist')
    cy.get('.image').eq(1).should('have.attr', 'src', 'http://127.0.0.1:8000/assets/img/login.svg');
    cy.contains('Selamat Datang').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit dan password anda untuk Masuk.').should('exist')
    cy.contains('Belum punya akun?').should('exist')
  })

  it('displays masuk, daftar and lupa password button', () => {
    cy.get('button[type=submit]').should('exist')
    cy.contains('Masuk').should('exist')
    cy.contains('Lupa Password?').should('exist')
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Daftar').should('exist')
  })

  it('click daftar dan lupa password button', () => {
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Daftar').should('exist')
    cy.get('button.btn.transparent').eq(0).click();
    cy.contains('Daftar').should('exist')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=email]').should('exist')
    cy.get('input[name=password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')

    cy.get('button.btn.transparent').eq(1).click();

    cy.contains('Lupa Password?').should('exist')
    cy.contains('Lupa Password?').click()
    cy.contains('Lupa Password').should('exist')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=email]').should('exist')
    cy.get('input[name=password]').should('exist')

    cy.get('button[type=button]').should('exist')
    cy.get('button[type=button]').click()
  })

  it('can submit login form for admin', () => {
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'http://127.0.0.1:8000/dashboard')
    // cy.contains('Berhasil Masuk').should('exist')
    // cy.contains('Selamat Datang').should('exist')
    cy.contains('OK').click()
  })

  it('can submit login form for karyawan', () => {
    cy.get('input[name=nik]').eq(0).type('000286')
    cy.get('input[name=password]').eq(0).type('000286')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'http://127.0.0.1:8000/home')
    cy.contains('Ganti Password').should('exist')
    cy.contains('Anda dapat mengganti password di halaman Ganti Sandi').should('exist')
    cy.contains('OK').click()
  })

  it('submit wrong credentials', () => {
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000')
    cy.get('button[type=submit]').eq(0).click()

    cy.contains('Login Gagal').should('exist')
    cy.contains('NIK atau kata sandi salah!').should('exist')
    cy.contains('Ok').click()

    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('111111')
    cy.get('button[type=submit]').eq(0).click()

    cy.contains('Login Gagal').should('exist')
    cy.contains('NIK atau kata sandi salah!').should('exist')
    cy.contains('Ok').click()

    // nik tidak terdaftar
    cy.get('input[name=nik]').eq(0).type('303030')
    cy.get('input[name=password]').eq(0).type('303030')
    cy.get('button[type=submit]').eq(0).click()

    cy.contains('NIK tidak terdaftar').should('exist')
    cy.contains('Pastikan NIK yang Anda masukkan sudah benar.').should('exist')
    cy.contains('OK').click()
  })

  it('check remember me when login', () => {
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('input[name="remember"]').check();
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'http://127.0.0.1:8000/dashboard')
    // cy.contains('Berhasil Masuk').should('exist')
    // cy.contains('Selamat Datang').should('exist')
    cy.contains('OK').click()

    cy.window().then(win => {
      win.location.href = 'about:blank'; // Menutup jendela
      cy.visit('http://127.0.0.1:8000/'); // Membuka kembali situs
    });

    // Memeriksa apakah pengguna tetap masuk atau kembali ke halaman login
    // cy.url().should('include', 'http://127.0.0.1:8000/dashboard');
    // cy.contains('Selamat Datang').should('exist'); // Harusnya tetap masuk
    cy.contains('Login').should('not.exist');
    cy.contains('OK').click()
  })

  it('submit unverified email account', () => {
    cy.get('input[name=nik]').eq(0).type('229792')
    cy.get('input[name=password]').eq(0).type('229792120700')
    cy.get('button[type=submit]').eq(0).click()

    cy.contains('Belum terverifikasi').should('exist')
    cy.contains('Silahkan lakukan verifikasi link terlebih dahulu').should('exist')
    cy.contains('OK').click()
  })

})