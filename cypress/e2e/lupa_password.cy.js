describe('Lupa Password Form', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.visit('http://localhost:8000/lupa-password');
  });
  it('submits the form and checks for success message', () => {
    // Buka halaman dengan URL yang sesuai

    // Isi input NIK
    cy.get('input[name=nik]').type('111111');

    // Isi input Email
    cy.get('input[name=email]').type('hildakh07@yahoo.com');

    // Submit formulir
    cy.get('.sign-up-form').submit();
  });

  it('select cancel button', () => {
    // Buka halaman dengan URL yang sesuai
    cy.visit('http://localhost:8000/lupa-password');

    // Submit formulir tanpa mengisi NIK dan Email
    cy.get('button[type=button]').click()
    cy.url().should('include', '/')
  });
});
