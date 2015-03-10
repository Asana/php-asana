<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Error;

class ClientTest extends Test\AsanaTest
{
    public function testClientGet()
    {
        $res = '{ "data": { "name": "test" }}';
        $this->dispatcher->registerResponse('/users/me', 200, $res);
        $result = $this->client->users->me();
        $this->assertEquals($result->name, "test");
    }

    /**
     * @expectedException Asana\Errors\NoAuthorizationError
     */
    public function testNotAuthorized()
    {
        $res = '{ "errors": [{ "message": "Not Authorized" }]}';
        $this->dispatcher->registerResponse('/users/me', 401, $res);
        $this->client->users->me();
    }

    /**
     * @expectedException Asana\Errors\InvalidRequestError
     */
    public function testInvalidRequest()
    {
        $res = '{ "errors": [{ "message": "workspace: Missing input" }] }';
        $this->dispatcher->registerResponse('/tasks', 400, $res);
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
        $res = '{ "errors": [ { "message": "user: Unknown object: 1234124312341" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 404, $res);
        $this->client->users->findById(1234);
    }

    /**
     * @expectedException Asana\Errors\ForbiddenError
     */
    public function testNotForbidden()
    {
        $res = '{ "errors": [ { "message": "user: Forbidden" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 403, $res);
        $this->client->users->findById(1234);
    }

    // def test_option_pretty(self):
    //     res = {
    //         "data": { "email": "sanchez@...", "id": 999, "name": "Greg Sanchez" }
    //     }
    //     # responses.add(GET, 'http://app/users/me?opt_pretty', status=200, body=json.dumps(res), match_querystring=True)
    //     responses.add(GET, 'http://app/users/me?opt_pretty=true', status=200, body=json.dumps(res), match_querystring=True)
    //     self.assertEqual(self.client.users.me(pretty=True), res['data']) 

    // def test_option_fields(self):
    //     res = {
    //         "data": { "name": "Make a list", "notes": "Check it twice!", "id": 1224 }
    //     }
    //     responses.add(GET, 'http://app/tasks/1224?opt_fields=name%2Cnotes', status=200, body=json.dumps(res), match_querystring=True)
    //     self.assertEqual(self.client.tasks.find_by_id(1224, fields=['name','notes']), res['data'])

    // def test_option_expand(self):
    //     req = {
    //         'data': { 'assignee': 1234 },
    //         'options': { 'expand' : ['projects'] }
    //     }
    //     res = {
    //         "data": {
    //             "id": 1001,
    //             "projects": [
    //                 {
    //                     "archived": false,
    //                     "created_at": "",
    //                     "followers": [],
    //                     "modified_at": "",
    //                     "notes": "",
    //                     "id": 1331,
    //                     "name": "Things to buy"
    //                 }
    //             ]
    //             # ...
    //         }
    //     }
    //     responses.add(PUT, 'http://app/tasks/1001', status=200, body=json.dumps(res), match_querystring=True)
    //     # -d "assignee=1234" \
    //     # -d "options.expand=%2Aprojects%2A"
    //     self.assertEqual(self.client.tasks.update(1001, req['data'], expand=['projects']), res['data'])
    //     self.assertEqual(json.loads(responses.calls[0].request.body), req)

    // def test_pagination(self):
    //     res = {
    //         "data": [
    //             { "id": 1000, "name": "Task 1" }
    //         ],
    //         "next_page": {
    //             "offset": "yJ0eXAiOiJKV1QiLCJhbGciOiJIRzI1NiJ9",
    //             "path": "/tasks?project=1337&limit=5&offset=yJ0eXAiOiJKV1QiLCJhbGciOiJIRzI1NiJ9",
    //             "uri": "https://app.asana.com/api/1.0/tasks?project=1337&limit=5&offset=yJ0eXAiOiJKV1QiLCJhbGciOiJIRzI1NiJ9"
    //         }
    //     }
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=5&offset=eyJ0eXAiOJiKV1iQLCJhbGciOiJIUzI1NiJ9', status=200, body=json.dumps(res), match_querystring=True)

    //     self.assertEqual(self.client.tasks.find_by_project(1337, { 'limit': 5, 'offset': 'eyJ0eXAiOJiKV1iQLCJhbGciOiJIUzI1NiJ9'}), res['data'])

    // @unittest.skip("iterator_type='pages' disabled")
    // def test_page_iterator_item_limit_lt_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=2, page_size=2, iterator_type='pages')
    //     self.assertEqual(next(iterator), ['a', 'b'])
    //     self.assertRaises(StopIteration, next, (iterator))

    // @unittest.skip("iterator_type='pages' disabled")
    // def test_page_iterator_item_limit_eq_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=1&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=3, page_size=2, iterator_type='pages')
    //     self.assertEqual(next(iterator), ['a', 'b'])
    //     self.assertEqual(next(iterator), ['c'])
    //     self.assertRaises(StopIteration, next, (iterator))

    // @unittest.skip("iterator_type='pages' disabled")
    // def test_page_iterator_item_limit_gt_items(self):
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2', status=200, body=json.dumps({ 'data': ['a', 'b'], 'next_page': { 'offset': 'a', 'path': '/projects/1337/tasks?limit=2&offset=a' } }), match_querystring=True)
    //     responses.add(GET, 'http://app/projects/1337/tasks?limit=2&offset=a', status=200, body=json.dumps({ 'data': ['c'], 'next_page': null }), match_querystring=True)

    //     iterator = self.client.tasks.find_by_project(1337, item_limit=4, page_size=2, iterator_type='pages')
    //     self.assertEqual(next(iterator), ['a', 'b'])
    //     self.assertEqual(next(iterator), ['c'])
    //     self.assertRaises(StopIteration, next, (iterator))

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


    // def test_get_named_parameters(self):
    //     responses.add(GET, 'http://app/tasks?workspace=14916&assignee=me', status=200, body=json.dumps({ 'data': 'dummy data' }), match_querystring=True)

    //     self.assertEqual(self.client.tasks.find_all(workspace=14916, assignee="me"), 'dummy data')

    // def test_post_named_parameters(self):
    //     responses.add(POST, 'http://app/tasks', status=201, body='{ "data": "dummy data" }', match_querystring=True)

    //     self.assertEqual(self.client.tasks.create(assignee=1235, followers=[5678], name="Hello, world."), 'dummy data')
    //     self.assertEqual(json.loads(responses.calls[0].request.body), {
    //         "data": {
    //             "assignee": 1235,
    //             "followers": [5678],
    //             "name": "Hello, world."
    //         }
    //     })

    // def test_put_named_parameters(self):
    //     responses.add(PUT, 'http://app/tasks/1001', status=200, body='{ "data": "dummy data" }', match_querystring=True)

    //     self.assertEqual(self.client.tasks.update(1001, assignee=1235, followers=[5678], name="Hello, world."), 'dummy data')
    //     self.assertEqual(json.loads(responses.calls[0].request.body), {
    //         "data": {
    //             "assignee": 1235,
    //             "followers": [5678],
    //             "name": "Hello, world."
    //         }
    //     })

}
