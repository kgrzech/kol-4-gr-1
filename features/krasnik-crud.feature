Feature: I would like to edit Krasnik

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/krasnik/"
    Then I should not see "<krasnik>"
    And I follow "Create a new entry"
    Then I should see "Krasnik creation"
    When I fill in "Name" with "<krasnik>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<krasnik>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    |krasnik   |caption         |size |
    |mlynska    |ul. mlynska    |15   |
    |strazacka  |ul. strazacka  |26   |
    |krotka     |ul. krotka     |37   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/krasnik/"
    Then I should not see "<new-krasnik>"
    When I follow "<old-krasnik>"
    Then I should see "<old-krasnik>"
    When I follow "Edit"
    And I fill in "Name" with "<new-krasnik>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-krasnik>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-krasnik>"

  Examples:
    |old-krasnik |new-krasnik |new-caption    |new-size|
    |mlynska     |wierzbowa   |ul. wierzbowa  |48      |
    |krotka      |swierkowa   |ul. swierkowa  |59      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/krasnik/"
    Then I should see "<krasnik>"
    When I follow "<krasnik>"
    Then I should see "<krasnik>"
    When I press "Delete"
    Then I should not see "<krasnik>"

  Examples:
    |krasnik    |
    |wierzbowa  |
    |strazacka  |
    |swierkowa  |