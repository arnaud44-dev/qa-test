describe('Inscription', () => {
    it('Inscription site web', () => {
        cy.visit('http://localhost/siteweb/inscription.php');
        cy.get("#name")
            .type("arnaud");
        cy.get("#inputFirstName")
            .type("van")
        cy.get("#inputEmail")
            .type('arnaud.vnd@gmail.com')
        cy.get("#inputAdresse")
            .type("109 la huperie 44690 monnieres")
        cy.get("#inputPassword")
            .type("Test12345!")
        cy.get("#NWSL_RGPD")
            .click()
        cy.get("#btn-inscription")
            .click()
    })
})
