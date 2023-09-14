describe('Can delete record', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Data Karyawan').click()
  });

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()

    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })
  
})