Feature: I would like to edit elk

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/elk/"
    Then I should not see "<elk>"
     And I follow "Create a new entry"
    Then I should see "Elk creation"
    When I fill in "Name" with "<elk>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<elk>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | elk       | caption               | size  |
    | dolna     | great                 |  689  |
    | jagienki  | oh good jagienki      |  890  |
    | sosnowa   | opis sosnowa          |  765  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/elk/"
    Then I should not see "<new-elk>"
    When I follow "<old-elk>"
    Then I should see "<old-elk>"
    When I follow "Edit"
     And I fill in "Name" with "<new-elk>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-elk>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-elk>"

  Examples:
    | old-elk     | new-elk     |   new-caption        | new-size    |
    | jagienki    | N-E-W-J-A-G |   ala ma kota        | 8888        |
    | sosnowa     | S-O-S-S-O-S |   zadam to i tyle    | 9999        |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/elk/"
    Then I should see "<elk>"
    When I follow "<elk>"
    Then I should see "<elk>"
    When I press "Delete"
    Then I should not see "<elk>"

  Examples:
    |  elk        |
    | dolna       |
    | N-E-W-J-A-G |
    | S-O-S-S-O-S |