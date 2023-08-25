describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('222222')
    cy.get('button[type=submit]').eq(0).click()
    cy.visit('http://localhost:8000/home');
  });

  it('displays informations on the page', () => {
    cy.contains('Konfirmasi Absensi ke EB.');
    cy.contains('Konfirmasi OCHI & QCC ke Training.');
    cy.contains('Maksimal Konfirmasi 3 hari.');
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.');
    cy.contains('Sandi dapat diganti di halaman Ganti Sandi.');
  });

  it('can navigate to change password page', () => {
    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').click();
    cy.url().should('include', '/change-password');
  });

  it('can logout', () => {
    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Keluar').click();
    cy.url().should('include', '/');
  });
});
