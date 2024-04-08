<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class TagTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Tests the tag page.
     */
    public function testTagPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags')
                    ->assertSee('Tags');
        });
    }

    /**
     * Tests the tag creation.
     */
    public function testTagCreation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/create')
                    ->type('name', 'Tag 1')
                    ->press('Create')
                    ->assertPathIs('/tags')
                    ->assertSee('Tag 1');
        });
    }

    /**
     * Tests the tag edition.
     */
    public function testTagEdition()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/1/edit')
                    ->type('name', 'Tag 2')
                    ->press('Update')
                    ->assertPathIs('/tags')
                    ->assertSee('Tag 2');
        });
    }

/**
     * Tests the tag deletion.
     */
    public function testTagDeletion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags')
                    ->press('Delete')
                    ->assertDontSee('Tag 2');
        });
    }

    /**
     * Tests the tag creation with validation errors.
     */
    public function testTagCreationValidationErrors()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/create')
                    ->press('Create')
                    ->assertSee('The name field is required.');
        });
    }

    /**
     * Tests the tag edition with validation errors.
     */
    public function testTagEditionValidationErrors()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/1/edit')
                    ->type('name', '')
                    ->press('Update')
                    ->assertSee('The name field is required.');
        });
    }

    /**
     * Tests the tag creation with a name that already exists.
     */
    public function testTagCreationNameAlreadyExists()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/create')
                    ->type('name', 'Tag 37')
                    ->press('Create')
                    ->waitForText('The name has already been taken.', 5)
                    ->assertSee('The name has already been taken.');
        });
    }

    /**
     * Tests the tag edition with a name that already exists.
     */
    public function testTagEditionNameAlreadyExists()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/1/edit')
                    ->type('name', 'Tag 1')
                    ->press('Update')
                    ->waitForText('The name has already been taken.', 5)
                    ->assertSee('The name has already been taken.');
        });
    }

    /**
     * Tests the tag deletion with a tag that is associated with a post.
     */
    public function testTagDeletionAssociatedWithPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tags/1/edit')
                    ->type('name', 'Tag 2')
                    ->press('Update')
                    ->visit('/tags')
                    ->press('Delete')
                    ->waitForText('The tag is associated with a post.', 5)
                    ->assertSee('The tag is associated with a post.');
        });
    }
}
