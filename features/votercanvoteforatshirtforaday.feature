@votes
Feature:
    As a voter
    I can vote to select a tshirt that has not been picked up yet for a given day
    If an voting session for that day is opened

Scenario:
    A voter who has not voted yet for that day can vote for a tshirt
    if a voting session is opened
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2015"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 1 vote for the "03-01-2015"

Scenario:
    A voter who already voted yet for that day cannot vote for a tshirt
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And there is a TShirt with id "tshirt2"
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2015"
    And voter has voted for tshirt "tshirt1" for the "03-01-2015"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 1 vote for the "03-01-2015"

Scenario:
    A voter cannot vote for a unexistant tshirt
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2015"
    When I vote for the TShirt "tshirt2" for the "03-01-2015"
    Then TShirt "tshirt2" should have 0 vote for the "03-01-2015"

Scenario:
    A voter cannot vote if no voting session is opened
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And today is "01-01-2015"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 0 vote for the "03-01-2015"

Scenario:
    A voter cannot vote if today is outside of a voting session
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1"
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2014"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 0 vote for the "03-01-2015"

Scenario:
    A voter cannot vote for an already elected tshirt
    Given that I'm logged in as Voter "voter1"
    And there is a TShirt with id "tshirt1" that was elected
    And there is a voting a session for the "03-01-2015" opened from "01-01-2015" to "02-01-2015"
    And today is "01-01-2015"
    When I vote for the TShirt "tshirt1" for the "03-01-2015"
    Then TShirt "tshirt1" should have 0 vote for the "03-01-2015"


