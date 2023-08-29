describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/')
    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('222222')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'http://localhost:8000/home')
    cy.contains('OK').click()
  });

  it('displays informations on the page', () => {
    cy.contains('Home').should('exist')
    cy.contains('111111').should('exist')
    cy.get('.bi-person-circle').should('exist')

    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')

    cy.contains('Selamat Datang').should('exist');
    cy.contains('Mohon Diperhatikan').should('exist');
    cy.contains('Konfirmasi Absensi ke EB.').should('exist');
    cy.contains('Konfirmasi OCHI & QCC ke Training.').should('exist');
    cy.contains('Maksimal Konfirmasi pada tanggal 20 September 2023 jam 10.00 WIB.').should('exist');
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.').should('exist');
    cy.contains('Sandi dapat diganti di halaman Ganti Sandi.').should('exist');
    cy.get('.btn-get-started').should('exist')
    cy.contains('Lihat Data').should('exist')
    cy.get('.bi-arrow-right').should('exist')

    cy.get('.img-fluid').should('have.attr', 'src', 'http://localhost:8000/assets/img/8.png');
    cy.get('.hero-waves').should('exist');
    cy.get('.wave1').should('exist');
    cy.get('.wave2').should('exist');
    cy.get('.wave3').should('exist');
  });

  it('display web on mobile phone', () => {
    cy.viewport('iphone-6');
    cy.get('.dropdown').click();
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')
    cy.get('.dropdown').click()

    cy.get('.btn-get-started').should('exist');
    // cy.url().should('include', '#main');

    cy.get('.container.mobile').should('exist')
  })

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
