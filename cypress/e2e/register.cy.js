describe('Register Page', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.sdn108gresik.sch.id/')
    cy.get('button.btn.transparent').should('exist');
    cy.get('button.btn.transparent').eq(0).click();
  });

  it('displays username, password, remember inputs', () => {
    cy.contains('Daftar').should('exist')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=email]').should('exist')
    cy.get('input[name=password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')
    cy.get('.image').eq(0).should('have.attr', 'src', 'https://datakaryawan.sdn108gresik.sch.id/assets/img/register.svg');
    cy.contains('Selamat Datang').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit, password, dan konfirmasi password untuk Mendaftar.').should('exist')
    cy.contains('Sudah punya akun?').should('exist')
  })

  it('displays masuk, daftar button and click masuk', () => {
    cy.get('button[type=submit]').should('exist')
    cy.contains('Daftar').should('exist')
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Masuk').should('exist')

    // click masuk
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Masuk').should('exist')
    cy.get('button.btn.transparent').eq(1).click();
    
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=password]').should('exist')
    cy.get('input[name=remember]').should('exist')
    cy.contains('Selamat Datang').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit dan password anda untuk Masuk.').should('exist')
    cy.contains('Belum punya akun?').should('exist')

    cy.get('button[type=submit]').should('exist')
    cy.contains('Masuk').should('exist')
    cy.contains('Lupa Password?').should('exist')
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Daftar').should('exist')
  })

  it('register with all credentials true', () => {
    cy.get('input[name=nik]').eq(1).type('229792')
    cy.get('input[name=email]').type('hildakh07@gmail.com')
    cy.get('input[name=password]').eq(1).type('229792')
    cy.get('input[name=password_confirmation]').type('229792')
    cy.get('button[type=submit]').eq(1).click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/register')
    cy.contains('Link Verifikasi telah dikirim').should('exist')
    cy.contains('Silahkan periksa email anda untuk verifikasi email.').should('exist')
    cy.contains('OK').click()
  })

  it('register with wrong credentials', () => {
    // first condition
    cy.get('input[name=nik]').eq(1).type('4545')
    cy.get('input[name=email]').type('hildakh07@gmail.com')
    cy.get('input[name=password]').eq(1).type('4545')
    cy.get('input[name=password_confirmation]').type('5656')
    cy.get('button[type=submit]').eq(1).click()

    cy.contains('Gagal Mendaftar').should('exist')
    cy.contains('NIK harus memiliki minimal 6 karakter.').should('exist')
    cy.contains('Email sudah digunakan.').should('exist')
    cy.contains('Password harus memiliki minimal 6 karakter.').should('exist')
    cy.contains('Konfirmasi password tidak cocok.').should('exist')
    cy.contains('Konfirmasi password tidak cocok dengan password.').should('exist')
    cy.contains('OK').click()

    cy.get('button.btn.transparent').should('exist');
    cy.get('button.btn.transparent').eq(0).click();

    // second condition
     cy.get('input[name=nik]').eq(1).type('111111')
     cy.get('input[name=email]').type('hildakh07@gmail.com')
     cy.get('input[name=password]').eq(1).type('4545')
     cy.get('input[name=password_confirmation]').type('5656')
     cy.get('button[type=submit]').eq(1).click()
 
     cy.contains('Gagal Mendaftar').should('exist')
     cy.contains('NIK sudah terdaftar.').should('exist')
     cy.contains('Email sudah digunakan.').should('exist')
     cy.contains('Password harus memiliki minimal 6 karakter.').should('exist')
     cy.contains('Konfirmasi password tidak cocok.').should('exist')
     cy.contains('Konfirmasi password tidak cocok dengan password.').should('exist')
     cy.contains('OK').click()
  })

})