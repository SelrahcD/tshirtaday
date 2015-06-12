Feature:
    As a voter
    I can vote to select a tshirt that has not been picked up yet for a given day
    If an voting session for that day is opened

Scenario: Vote for a TShirt that has not been picked up yet
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2015"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 1 vote for the "03-01-2015" 



