Feature: I would like to edit katowice

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/katowice/"
    Then I should not see "<katowice>"
     And I follow "Create a new entry"
    Then I should see "Katowice creation"
    When I fill in "Name" with "<katowice>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<katowice>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | katowice     | caption     | size|
    | wesola       | super ulica |  10 |
    | smieszna     | fajna ulica |  12 |
    | kolorowa     | ok ulica    |  15 |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/katowice/"
    Then I should not see "<new-katowice>"
    When I follow "<old-katowice>"
    Then I should see "<old-katowice>"
    When I follow "Edit"
     And I fill in "Name" with "<new-katowice>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-katowice>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-katowice>"

  Examples:
    | old-katowice     | new-katowice  | new-caption    | new-size |
    | wesola           | rumiankowa    | dobra ulica    |   5      |
    | smieszna         | stokrotkowa   | zla ulica      |   6      |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/katowice/"
    Then I should see "<katowice>"
    When I follow "<katowice>"
    Then I should see "<katowice>"
    When I press "Delete"
    Then I should not see "<katowice>"

  Examples:
    |  katowice    |
    | kolorowa     |
    | rumiankowa   |
    | stokrotkowa  |