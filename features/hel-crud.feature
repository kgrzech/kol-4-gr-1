Feature: I would like to edit hel

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hel/"
    Then I should not see "<hel>"
     And I follow "Create a new entry"
    Then I should see "Hel creation"
    When I fill in "Name" with "<hel>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<hel>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | hel         | caption| size |
    | Bałtycka    | ulica  |  1   |
    | Boczna      | ulica  |  2   |
    | Dworcowa    | ulica  |  3   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hel/"
    Then I should not see "<new-hel>"
    When I follow "<old-hel>"
    Then I should see "<old-hel>"
    When I follow "Edit"
     And I fill in "Name" with "<new-hel>"
     And I fill in "Caption" with "<new-caption>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-hel>"
     And I should see "<new-caption>"
     And I should not see "<old-hel>"

  Examples:
    | old-hel         | new-hel           | new-caption|
    | Bałtycka        | B-A-L-T-Y-C-K-A   | new-ulica  |
    | Boczna          | B-O-C-Z-N-A       | new-ulica  |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hel/"
    Then I should see "<hel>"
    When I follow "<hel>"
    Then I should see "<hel>"
    When I press "Delete"
    Then I should not see "<hel>"

  Examples:
    |  hel            |
    | Bałtycka        |
    | B-A-L-T-Y-C-K-A |
    | B-O-C-Z-N-A     |