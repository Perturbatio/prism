<?php

declare(strict_types=1);

namespace EchoLabs\Prism\Text;

use Closure;
use EchoLabs\Prism\Contracts\Message;
use EchoLabs\Prism\Enums\ToolChoice;
use EchoLabs\Prism\Tool;

class Request
{
    /**
     * @param  array<int, Message>  $messages
     * @param  array<int, Tool>  $tools
     * @param  array<string, mixed>  $clientOptions
     * @param  array{0: array<int, int>|int, 1?: Closure|int, 2?: ?callable, 3?: bool}  $clientRetry
     * @param  array<string, mixed>  $providerMeta
     */
    public function __construct(
        public readonly string $model,
        public readonly ?string $systemPrompt,
        public readonly ?string $prompt,
        public readonly array $messages,
        public readonly int $maxSteps,
        public readonly ?int $maxTokens,
        public readonly int|float|null $temperature,
        public readonly int|float|null $topP,
        public readonly array $tools,
        public readonly array $clientOptions,
        public readonly array $clientRetry,
        public readonly string|ToolChoice|null $toolChoice,
        public readonly array $providerMeta,
    ) {}

    public function addMessage(Message $message): self
    {
        $messages = array_merge($this->messages, [$message]);

        return new self(
            systemPrompt: $this->systemPrompt,
            model: $this->model,
            prompt: $this->prompt,
            messages: $messages,
            maxSteps: $this->maxSteps,
            maxTokens: $this->maxTokens,
            temperature: $this->temperature,
            topP: $this->topP,
            tools: $this->tools,
            clientOptions: $this->clientOptions,
            clientRetry: $this->clientRetry,
            toolChoice: $this->toolChoice,
            providerMeta: $this->providerMeta,
        );
    }
}
