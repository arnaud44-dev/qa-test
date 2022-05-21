describe('tests login', () => {
    it('login site web', () => {
        cy.visit('http://localhost/qa-test/siteweb/login.php');
        cy.get('#inputEmail');
    })
});
