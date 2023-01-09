<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    // if you want to use the database in your tests, add the following line
    use RefreshDatabase;

    public function test_can_home_page_be_displayed_for_not_logged_in_user()
    {
        // arrange

        // act
        $response = $this->get('/');

        // assert
        $response->assertStatus(200);
        // at this moment the home page shows the text 'pizza' and 'logo' in the html
        // this must be changed to a more fitting title
        $response->assertSeeText('pizza');
    }

    public function test_can_home_page_be_displayed_for_logged_in_user()
    {
        // arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->get('/');

        // assert
        $response->assertStatus(200);
        // at this moment the home page shows the text 'pizza' and 'logo' in the html
        // this must be changed to a more fitting title
        $response->assertSeeText('pizza');
        // a logged in user should see the user's user_name in the html
        $response->assertSeeText($user->user_name);
        // a logged in user will be shown the dashboard blade and the "layouts.navigation-aside" blade
        // the "layouts.navigation-aside" blade contains the text 'Dashboard' in the html
        // If you change the text in the "layouts.navigation-aside" blade, you must change the text here
        $response->assertSeeText('Dashboard');
    }

    public function test_not_logged_in_user_cannot_access_dashboard()
    {
        // arrange

        // act
        $response = $this->get('/dashboard');

        // assert
        // a not logged in user will be redirected to the login page
        $response->assertStatus(302);
        // a button with the text 'login' is shown on the login page (be aware of the lowercase 'l' in 'login')
        $response->assertSeeText('login');
        // a not logged in user will not be shown the dashboard blade and the "layouts.navigation-aside" blade
        $response->assertDontSeeText('Dashboard');
    }
}
