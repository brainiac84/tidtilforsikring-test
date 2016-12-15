<?php

class MappingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * @dataProvider genPositiveTestCases
     * @param $urlSuffix
     * @param $queryParams
     * @param $expectedResult
     */
    public function testAllPositiveMappingResults($urlSuffix, $queryParams, $expectedResult)
    {
        $this->post('/calculate/'.$urlSuffix, $queryParams)
            ->seeJsonEquals($expectedResult)
            ->assertResponseOk();
    }

    public function genPositiveTestCases()
    {
        return [
            ['base', ['A' => true, 'B' => true, 'C' => false, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'S', 'Y' => 11]],
            ['base', ['A' => true, 'B' => true, 'C' => true, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'R', 'Y' => 10]],
            ['base', ['A' => false, 'B' => true, 'C' => true, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'T', 'Y' => 9]],
            ['specialized1', ['A' => true, 'B' => true, 'C' => true, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'R', 'Y' => 21]],
            ['specialized2', ['A' => true, 'B' => true, 'C' => false, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'T', 'Y' => 9]],
            ['specialized2', ['A' => true, 'B' => false, 'C' => true, 'D' => 10, 'E' => 10, 'F' => 10], ['X' => 'S', 'Y' => 21]],
        ];
    }

    /**
     * @dataProvider genNegativeTestCases
     * @param $urlSuffix
     * @param $queryParams
     */
    public function testAllNegativeResults($urlSuffix, $queryParams)
    {
        $this->post('/calculate/'.$urlSuffix, $queryParams)
            ->seeJsonStructure(['error'])
            ->assertResponseOk();
    }

    public function genNegativeTestCases()
    {
        return [
            ['base', ['A' => false, 'B' => false, 'C' => false, 'D' => 10, 'E' => 10, 'F' => 10]],
            ['specialized1', ['A' => false, 'B' => false, 'C' => false, 'D' => 10, 'E' => 10, 'F' => 10]],
            ['specialized2', ['A' => false, 'B' => false, 'C' => false, 'D' => 10, 'E' => 10, 'F' => 10]],
        ];
    }

}
