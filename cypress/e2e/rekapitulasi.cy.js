describe('Halaman Admin', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').type('000000')
    cy.get('input[name=password]').type('000000')
    cy.get('button[type=submit]').click()
    cy.visit('http://localhost:8000/dashboard');
  });

  it('Upload data', () => {
    cy.visit('http://localhost:8000/absensi');
  })
})