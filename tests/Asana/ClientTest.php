<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Error;

class ClientTest extends Test\AsanaTest
{
    public function testClientGet()
    {
        $this->dispatcher->registerResponse('/users/me', 200, '{ "data": "foo" }');
        $result = $this->client->users->me();
        $this->assertEquals($result, 'foo');
    }

    /**
     * @expectedException Asana\Errors\NoAuthorizationError
     */
    public function testNotAuthorized()
    {
        $this->dispatcher->registerResponse('/users/me', 401, '{ "errors": [{ "message": "Not Authorized" }]}');
        $this->client->users->me();
    }

    /**
     * @expectedException Asana\Errors\InvalidRequestError
     */
    public function testInvalidRequest()
    {
        $this->dispatcher->registerResponse('/tasks', 400, '{ "errors": [{ "message": "workspace: Missing input" }] }');
        $this->client->tasks->findAll();
    }

    /**
     * @expectedException Asana\Errors\ServerError
     */
    public function testServerError()
    {
        $res = '{ "errors": [ { "message": "Server Error", "phrase": "6 sad squid snuggle softly" } ] }';
        $this->dispatcher->registerResponse('/users/me', 500, $res);
        $this->client->users->me();
    }

    /**
     * @expectedException Asana\Errors\NotFoundError
     */
    public function testNotFound()
    {
        $res = '{ "errors": [ { "message": "user: Unknown object: 1234" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 404, $res);
        $this->client->users->findById(1234);
    }

    /**
     * @expectedException Asana\Errors\ForbiddenError
     */
    public function testForbidden()
    {
        $res = '{ "errors": [ { "message": "user: Forbidden" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 403, $res);
        $this->client->users->findById(1234);
    }

    public function testOptionPretty()
    {
        $this->dispatcher->registerResponse('/users/me?opt_pretty=true', 200, '{ "data": "foo" }');
        $this->assertEquals($this->client->users->me(null, array('pretty' => true)), 'foo');
    }

    public function testOptionFields()
    {
        $this->dispatcher->registerResponse('/tasks/1224?opt_fields=name%2Cnotes', 200, '{ "data": "foo" }');
        $result = $this->client->tasks->findById(1224, null, array("fields" => array('name','notes')));
        $this->assertEquals($result, 'foo');
    }

    public function testOptionExpand()
    {
        $req = '{ "data": { "assignee": 1234 }, "options": { "expand" : ["projects"] } }';
        $this->dispatcher->registerResponse('/tasks/1001', 200, '{ "data": "foo" }');
        $result = $this->client->tasks->update(1001, array('assignee' => 1234), array('expand' => array('projects')));
        $this->assertEquals($result, 'foo');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }

    public function testPagination()
    {
        $res = '{
            "data": [
                { "id": 1000, "name": "Task 1" }
            ],
            "next_page": {
                "offset": "ABCDEF",
                "path": "/tasks?project=1337&limit=5&offset=ABCDEF",
                "uri": "https://app.asana.com/api/1.0/tasks?project=1337&limit=5&offset=ABCDEF"
            }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=5&offset=ABCDEF', 200, $res);
        $result = $this->client->tasks->findByProject(1337, array('limit' => 5, 'offset' => 'ABCDEF'));
        $this->assertEquals($result, json_decode($res)->data);
    }

    // def test_item_iterator_item_limit_lt_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=2, page_size=2, iterator_type='items')
    //     self.assertEqual(next(iterator), 'a')
    //     self.assertEqual(next(iterator), 'b')
    //     self.assertRaises(StopIteration, next, (iterator))

    // def test_item_iterator_item_limit_eq_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=1&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=3, page_size=2, iterator_type='items')
    //     self.assertEqual(next(iterator), 'a')
    //     self.assertEqual(next(iterator), 'b')
    //     self.assertEqual(next(iterator), 'c')
    //     self.assertRaises(StopIteration, next, (iterator))

    // def test_item_iterator_item_limit_gt_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=4, page_size=2, iterator_type='items')
    //     self.assertEqual(next(iterator), 'a')
    //     self.assertEqual(next(iterator), 'b')
    //     self.assertEqual(next(iterator), 'c')
    //     self.assertRaises(StopIteration, next, (iterator))

    // def test_item_iterator_preserve_opt_fields(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2&opt_fields=foo', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=1&opt_fields=foo&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=3, page_size=2, fields=['foo'], iterator_type='items')
    //     self.assertEqual(next(iterator), 'a')
    //     self.assertEqual(next(iterator), 'b')
    //     self.assertEqual(next(iterator), 'c')
    //     self.assertRaises(StopIteration, next, (iterator))

    // @patch('time.sleep')
    // def test_rate_limiting(self, time_sleep):
    //     res = [
    //         (429, { 'Retry-After': '10' }, '{}'),
    //         (200, {}, json.dumps({ 'data': 'me' }))
    //     ]
    //     responses.add_callback(responses.GET, 'http://app/users/me', callback=lambda r: res.pop(0), content_type='application/json')

    //     self.assertEqual(self.client.users.me(), 'me')
    //     self.assertEqual(len(responses.calls), 2)
    //     self.assertEqual(time_sleep.mock_calls, [call(10.0)])

    // @patch('time.sleep')
    // def test_rate_limited_twice(self, time_sleep):
    //     res = [
    //         (429, { 'Retry-After': '10' }, '{}'),
    //         (429, { 'Retry-After': '1' }, '{}'),
    //         (200, {}, json.dumps({ 'data': 'me' }))
    //     ]
    //     responses.add_callback(responses.GET, 'http://app/users/me', callback=lambda r: res.pop(0), content_type='application/json')

    //     self.assertEqual(self.client.users.me(), 'me')
    //     self.assertEqual(len(responses.calls), 3)
    //     self.assertEqual(time_sleep.mock_calls, [call(10.0), call(1.0)])

    // @patch('time.sleep')
    // def test_server_error_retry(self, time_sleep):
    //     res = [
    //         (500, {}, '{}'),
    //         (500, {}, '{}'),
    //         (500, {}, '{}'),
    //         (200, {}, json.dumps({ 'data': 'me' }))
    //     ]
    //     responses.add_callback(responses.GET, 'http://app/users/me', callback=lambda r: res.pop(0), content_type='application/json')

    //     self.assertRaises(asana.error.ServerError, self.client.users.me, max_retries=2)
    //     self.assertEqual(time_sleep.mock_calls, [call(1.0), call(2.0)])

    // @patch('time.sleep')
    // def test_server_error_retry_backoff(self, time_sleep):
    //     res = [
    //         (500, {}, '{}'),
    //         (500, {}, '{}'),
    //         (500, {}, '{}'),
    //         (200, {}, json.dumps({ 'data': 'me' }))
    //     ]
    //     responses.add_callback(responses.GET, 'http://app/users/me', callback=lambda r: res.pop(0), content_type='application/json')

    //     self.assertEqual(self.client.users.me(), 'me')
    //     self.assertEqual(time_sleep.mock_calls, [call(1.0), call(2.0), call(4.0)])

    public function testGetNamedParameters()
    {
        $this->dispatcher->registerResponse('/tasks?workspace=14916&assignee=me', 200, '{ "data": "dummy data" }');
        $result = $this->client->tasks->findAll(array('workspace' => 14916, 'assignee' => 'me'));
        $this->assertEquals($result, 'dummy data');
    }

    public function testPostNamedParameters()
    {
        $req = '{
            "data": {
                "assignee": 1235,
                "followers": [5678],
                "name": "Hello, world."
            }
        }';
        $this->dispatcher->registerResponse('/tasks', 201, '{ "data": "dummy data" }');
        $result = $this->client->tasks->create(
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );
        $this->assertEquals($result, 'dummy data');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }

    public function testPutNamedParameters()
    {
        $req = '{
            "data": {
                "assignee": 1235,
                "followers": [5678],
                "name": "Hello, world."
            }
        }';
        $this->dispatcher->registerResponse('/tasks/1001', 200, '{ "data": "dummy data" }');
        $result = $this->client->tasks->update(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );
        $this->assertEquals($result, 'dummy data');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }
}
