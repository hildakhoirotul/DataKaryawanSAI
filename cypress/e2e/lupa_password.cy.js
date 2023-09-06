describe('Lupa Password Form', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.sdn108gresik.sch.id/')
    cy.contains('Lupa Password?').should('exist')
    cy.contains('Lupa Password?').click()
  });
  it('display all information', () => {
    cy.contains('Lupa Password').should('exist')
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=email]').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Submit').should('exist')
    cy.get('button.btn-cancel').should('exist')
    cy.contains('Cancel').should('exist')

    cy.get('.image').should('have.attr', 'src', 'https://datakaryawan.sdn108gresik.sch.id/assets/img/login.svg');
    cy.contains('Lupa Password Anda?').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit dan Email anda.').should('exist')
  });

  it('submit with true credentials', () => {
    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=email]').type('hildakh07@gmail.com')
    cy.get('button[type=submit]').click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/login')
    cy.contains('Berhasil Dikirim').should('exist')
    cy.contains('Silahkan Cek Email Anda dan Login kembali').should('exist')
    cy.contains('OK').click()
  });

  it('submit with wrong nik', () => {
    cy.get('input[name=nik]').type('888888')
    cy.get('input[name=email]').type('hildakh07@gmail.com')
    cy.get('button[type=submit]').click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/lupa-password')
    cy.contains('Gagal dikirim').should('exist')
    cy.contains('Pastikan nik dan email anda telah benar').should('exist')
    cy.contains('OK').click()
  });

  it('click on cancel button', () => {
    cy.get('button[type=button]').should('exist')
    cy.get('button[type=button]').click()
    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/login')
  })
});
