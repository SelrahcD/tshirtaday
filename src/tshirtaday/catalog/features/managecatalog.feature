Feature:
    As an admin
    I want to manage the TShirt Catalog

Scenario: Adding a TShirt to the catalog
    Given a new catalog is created
    When an admin adds a TShirt with description "La Ruda Japan Tour" to the catalog
    Then the catalog should contain 1 TShirt

Scenario: Removing a TShirt to the catalog
    Given a new catalog is created
    Given a TShirt with id 12345 is added to the catalog
    When an admin removes the TShirt with id 12345 from the catalog
    Then the catalog should contain 0 TShirt

