<?php

namespace denis909\yii;

trait AssertSentEmailTrait
{

    public function assertSentEmailCount(int $count)
    {
        $messages = $this->tester->grabSentEmails();

        $this->tester->assertGreaterOrEquals($count, count($messages));
    }

    public function assertSentEmail(string $email, ?string $subject)
    {
        $messages = $this->tester->grabSentEmails();

        foreach($messages as $message)
        {
            if (array_search($email, array_keys($message->getTo())) !== false)
            {
                if ($subject && ($message->getSubject() != $subject))
                {
                    continue;
                } 

                $this->assertTrue(true);

                return;
            }
        }

        $this->assertTrue(false, 'Message "' . $subject.'" to "' . $email . '" not found.');
    }

}
