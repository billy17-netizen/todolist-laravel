<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodoList()
    {
        $this->withSession([
            'user' => "Billy",
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Eko',
                ],
                [
                    'id' => '2',
                    'todo' => 'Kurnia',
                ],
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('Eko')
            ->assertSeeText('2')
            ->assertSeeText('Kurnia');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => "Billy"
        ])->post('/todolist',[])
            ->assertSeeText('Todo is required');
    }

    public function testaddTodoSucces()
    {
        $this->withSession([
            'user' => "Billy"
        ])->post('/todolist',[
            'todo' => 'Eko'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            'user' => "Billy",
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Eko',
                ],
                [
                    'id' => '2',
                    'todo' => 'Kurnia',
                ],
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }
}
