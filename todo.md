- pizza's crud
- orders crud
- uniform layout
- all english language translated on the pages (ui)
- tests
  - profile tests zijn gewijzigd
  - let op als je een actingAs een user wilt doen, gebruik dan:
    - $person = Person::factory()->create();
    - $user = $person->user;
  - het project wordt opgeleverd met 25 tests
  - kijk voor een voorbeeld naar HomeTest.php


- the create of a person is done by creating a user, editing is done by editing the profile
- so create (person) and edit (person) form are not used

- in the profile controller the person code (for updating) is added, but code for deleting is not done yet
- home page links must be edited/updated
- there is allso a side bar menu (for instance for product categories)
