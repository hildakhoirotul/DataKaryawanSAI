describe('Admin Dashboard', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').type('000000')
    cy.get('input[name=password]').type('000000')
    cy.get('button[type=submit]').click()
    cy.visit('http://localhost:8000/dashboard');
  });

  it('displays informations on the page', () => {
    cy.contains('Rekapitulasi Data Karyawan');
    cy.contains('000000');
    cy.contains('Disable Detail OCHI & QCC');
    cy.contains('Dashboard');
  });
})