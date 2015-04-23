Feature: I would like to edit Dabrowa

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dabrowa/"
    Then I should not see "<dabrowa>"
    And I follow "Create a new entry"
    Then I should see "Dabrowa creation"
    When I fill in "Name" with "<dabrowa>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<dabrowa>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    |dabrowa   |caption       |size |
    |akacjowa  |ul. akacjowa  |10   |
    |basniowa  |ul. basniowa  |11   |
    |cicha     |ul. cicha     |12   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dabrowa/"
    Then I should not see "<new-dabrowa>"
    When I follow "<old-dabrowa>"
    Then I should see "<old-dabrowa>"
    When I follow "Edit"
    And I fill in "Name" with "<new-dabrowa>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-dabrowa>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-dabrowa>"

  Examples:
    |old-dabrowa   |new-dabrowa |new-caption    |new-size|
    |akacjowa      |dolna       |ul. dolna      |50      |
    |cicha         |europejska  |ul. europejska |78      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dabrowa/"
    Then I should see "<dabrowa>"
    When I follow "<dabrowa>"
    Then I should see "<dabrowa>"
    When I press "Delete"
    Then I should not see "<dabrowa>"

  Examples:
    |dabrowa    |
    |dolna      |
    |basniowa   |
    |europejska |