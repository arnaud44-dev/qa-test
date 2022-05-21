describe('tests inscription', () => {
    it('inscription site web', () => {
        cy.visit('http://localhost/qa-test/siteweb/inscription.php');
        cy.get('#name');
    })
});
