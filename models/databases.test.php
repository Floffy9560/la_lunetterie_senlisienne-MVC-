// Import the necessary PHPUnit classes
use PHPUnit\Framework\TestCase;

class GetUserInfosTest extends TestCase
{
public function testGetUserInfosNoAppointment()
{
// Mock the getUserInfos function to return a user with no appointment
$mockUserInfos = [
'user_id' => 1,
'user_info_id' => 1,
'appointment_user_id' => null,
// Other user data...
];

// Replace the actual getUserInfos function with a mock function
$this->replaceFunction('getUserInfos', function ($mail) use ($mockUserInfos) {
return $mockUserInfos;
});

// Call the getUserInfos function
$result = getUserInfos('test@example.com');

// Verify that the appointment details are null
$this->assertNull($result['appointment_user_id']);
$this->assertNull($result['id_appointment']);
$this->assertNull($result['appointmentDate']);
$this->assertNull($result['appointmentTime']);

// Additional verification for user data
$this->assertEquals(1, $result['user_id']);
$this->assertEquals(1, $result['user_info_id']);
// Add more assertions if needed
}
}