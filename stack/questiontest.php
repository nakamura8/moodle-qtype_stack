<?php
// This file is part of Stack - http://stack.bham.ac.uk/
//
// Stack is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Stack is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Stack.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Holds the data defining one question test.
 *
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(dirname(__FILE__) . '/questiontestresult.php');
require_once(dirname(__FILE__) . '/potentialresponsetree.class.php');


/**
 * One question test.
 *
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class stack_question_test {
    /**
     * @var array input name => value to be entered.
     */
    public $inputs;

    /**
     * @var array prt name => stack_potentialresponse_tree_state object
     */
    public $expectedresults;

    /**
     * Constructor
     * @param array $inputs input name => value to enter.
     */
    public function __construct($inputs) {
        $this->inputs = $inputs;
    }

    /**
     * Set the expected result for one of the PRTs.
     * @param string $prtname which PRT.
     * @param stack_potentialresponse_tree_state $expectedresult the expected result
     *      for this PRT. Only the mark, penalty and answernote fields are used.
     */
    public function add_expected_result($prtname, stack_potentialresponse_tree_state $expectedresult) {
        $this->expectedresults[$prtname] = $expectedresult;
    }

    /**
     * Run this test against a particular question.
     * @param question_usage_by_activity $quba the useage to use when running the test.
     * @param qtype_stack_question $question the question to test.
     * @param int $seed the random seed to use.
     * @return stack_question_test_result the test results.
     */
    public function test_question(question_usage_by_activity $quba, qtype_stack_question $question, $seed) {

        $slot = $quba->add_question($question, $question->defaultmark);
        $quba->start_question($slot, $seed);

        $response = $this->compute_response($question);

        $quba->process_action($slot, $response);

        $results = new stack_question_test_result($this);
        foreach ($this->inputs as $inputname => $notused) {
            $inputstate = $question->get_input_state($inputname, $response);
            $results->set_input_state($inputname, $response[$inputname],
                    $inputstate->contentsdisplayed, $inputstate->status);
        }

        foreach ($this->expectedresults as $prtname => $expectedresult) {
            $result = $question->get_prt_result($prtname, $response);
            $results->set_prt_result($prtname, new stack_potentialresponse_tree_state(
                    '', $result['feedback'], explode(' | ', $result['answernote']),
                    $result['valid'], $result['score'], $result['penalty']));
        }

        return $results;
    }

    /**
     * Create the actual response data. The response data in the test case may
     * include expressions in terms of the question variables.
     * @param qtype_stack_question $question the question - with $question->session initialised.
     * @return array the respones to send to $quba->process_action.
     */
    protected function compute_response(qtype_stack_question $question) {
        $localoptions = clone $question->options;
        $localoptions->set_option('simplify', true);

        // Start with the quetsion variables (note that order matters here).
        $cascontext = new stack_cas_session(null, $localoptions, $question->seed);
        $question->add_question_vars_to_session($cascontext);

        // Now add the expressions we want evaluated.
        $vars = array();
        foreach ($this->inputs as $name => $value) {
            if ($value) {
                $cs = new stack_cas_casstring($value);
                $cs->validate('t');
                $cs->set_key('testresponse_' . $name);
                $vars[] = $cs;
            }
        }

        $cascontext->add_vars($vars);
        $cascontext->instantiate();

        $response = array();
        foreach ($this->inputs as $name => $notused) {
            $value = $cascontext->get_value_key('testresponse_' . $name);
            $response[$name] = $value;
            $response[$name . '_val'] = $value;
        }

        return $response;
    }

    /**
     * @param string $inputname the name of one of the inputs.
     * @return string the value to be entered into that input.
     */
    public function get_input($inputname) {
        return $this->inputs[$inputname];
    }
}
