describe('Login', () => {
  it('successfully loads', () => {
    cy.visit('http://localhost:8000/login') // Ganti URL sesuai dengan URL halaman login
  })

  it('displays username and password inputs', () => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=password]').should('exist')
  })

  it('displays login button', () => {
    cy.visit('http://localhost:8000/login')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Masuk').should('exist')
  })

  it('can submit login form', () => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').type('111111') // Ganti dengan username yang benar
    cy.get('input[name=password]').type('111111') // Ganti dengan password yang benar
    cy.get('button[type=submit]').click()

    // Periksa halaman setelah berhasil login, misalnya dengan URL atau elemen unik di halaman setelah login
    cy.url().should('include', 'http://localhost:8000/home') // Ganti dengan URL halaman setelah login
  })
})