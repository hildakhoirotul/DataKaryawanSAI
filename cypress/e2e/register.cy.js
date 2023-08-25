describe('Register Page', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/')
    cy.get('button.btn.transparent').should('exist');
    cy.get('button.btn.transparent').eq(0).click();
  });

  it('displays username, password, remember inputs', () => {
    cy.contains('Daftar').should('exist')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=email]').should('exist')
    cy.get('input[name=password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')
    cy.contains('Selamat Datang').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit, password, dan konfirmasi password untuk Mendaftar.').should('exist')
    cy.contains('Sudah punya akun?').should('exist')
  })

  it('displays masuk and daftar button', () => {
    cy.get('button[type=submit]').should('exist')
    cy.contains('Daftar').should('exist')
    cy.get('button.btn.transparent').should('exist');
    cy.contains('Masuk').should('exist')
  })
})