describe('Change Password', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=password]').type('111111')
    cy.get('button[type=submit]').click()
    cy.visit('http://localhost:8000/home');
    cy.get('#navbarDropdown').trigger('mouseover');
    cy.wait(1000);
    cy.get('.dropdown-item', { force: true }).should('be.visible');
    cy.contains('Ganti Sandi').click();
    cy.url().should('include', '/change-password');
  });

  it('display nik, current password, new password, confirmation', () => {
    cy.get('input[name=nik]').should('exist')
    cy.get('input[name=current_password]').should('exist')
    cy.get('input[name=new_password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist');
  });

  it('display ganti & cancel button', () => {
    cy.get('button[type=submit]').should('exist')
    cy.contains('GANTI').should('exist')
    cy.get('button[type=button]').should('exist')
    cy.contains('Cancel').should('exist');
  });

  it('cancel change password', () => {
    cy.get('button[type=button]').click()

    cy.url().should('include', '/home')
  });

  it('can submit change password', () => {
    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=current_password').type('111111')
    cy.get('input[name=new_password').type('222222')
    cy.get('input[name=password_confirmation').type('222222')
    cy.get('button[type=submit]').click()
    cy.get('.swal2-container').should('be.visible');

    // Klik di layar untuk menutup sweet alert
    cy.get('.swal2-container').click({ force: true });

    cy.url().should('include', '/login')
    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=password]').type('222222')
    cy.get('button[type=submit]').click()
    cy.visit('http://localhost:8000/home');

    cy.get('#navbarDropdown').trigger('mouseover');
    cy.wait(1000);
    cy.get('.dropdown-item', { force: true }).should('be.visible');
    cy.contains('Ganti Sandi').click();
    cy.url().should('include', '/change-password');

    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=current_password').type('222222')
    cy.get('input[name=new_password').type('111111')
    cy.get('input[name=password_confirmation').type('111111')
    cy.get('button[type=submit]').click()
  });
})