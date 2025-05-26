<?php

class DocumentProcessor {

    private $config;
    private $stats;

    public function __construct(array $config = []) {
        $this->config = array_merge([
            'lowercase' => true,
            'normalize_whitespace' => true,
            'trim_whitespace' => true,
            'remove_html' => false,
            'normalize_punctuation' => false,
            'max_line_length' => 0,
            'replace_urls' => false,
            'smart_quotes' => false,
            'language' => 'en'
        ], $config);
        
        $this->resetStats();
    }
    
    public function resetStats() {
        $this->stats = [
            'original_length' => 0,
            'processed_length' => 0,
            'word_count' => 0,
            'sentence_count' => 0,
            'whitespace_removed' => 0,
            'html_tags_removed' => 0,
            'processing_time' => 0
        ];
    }
    
    private function lowerCase($text) {
        return strtolower($text);
    }
    
    private function normSpace($text) {
        return preg_replace('/\s+/', ' ', $text);
    }
    
    private function trim($text) {
        return trim($text);
    }
    
    private function stripHTML($text) {
        $textWithoutHtml = strip_tags($text);
        $this->stats['html_tags_removed'] += strlen($text) - strlen($textWithoutHtml);
        return $textWithoutHtml;
    }
    
    private function normPunct($text) {
        $text = preg_replace('/--+/', '—', $text);
        
        $text = preg_replace('/\.\.\.+/', '…', $text);
        
        if ($this->config['smart_quotes']) {
            $text = preg_replace('/(\W|^)"(\w)/', '$1"$2', $text); 
            $text = preg_replace('/(\w)"(\W|$)/', '$1"$2', $text); 
            $text = preg_replace('/(\W|^)\'(\w)/', '$1\'$2', $text); 
            $text = preg_replace('/(\w)\'(\W|$)/', '$1\'$2', $text); 
        }
        
        return $text;
    }
    
    private function maskURLs($text) {
        return preg_replace(
            '/(https?:\/\/[^\s]+)/',
            '[URL]',
            $text
        );
    }
    
    private function wrapText($text) {
        if ($this->config['max_line_length'] <= 0) {
            return $text;
        }
        
        return wordwrap($text, $this->config['max_line_length'], "\n", true);
    }
    
    private function calcStats($text) {
        $this->stats['word_count'] = str_word_count($text);
        $this->stats['sentence_count'] = preg_match_all('/[.!?]+/', $text, $matches);
    }

    public function process($document) {
        $startTime = microtime(true);
        
        $this->stats['original_length'] = strlen($document);
        $normalized = $document;
        
        if ($this->config['remove_html']) {
            $normalized = $this->stripHTML($normalized);
        }
        
        if ($this->config['lowercase']) {
            $normalized = $this->lowerCase($normalized);
        }
        
        if ($this->config['normalize_punctuation']) {
            $normalized = $this->normPunct($normalized);
        }
        
        if ($this->config['replace_urls']) {
            $normalized = $this->maskURLs($normalized);
        }
        
        $whitespaceBefore = strlen($normalized);
        
        if ($this->config['normalize_whitespace']) {
            $normalized = $this->normSpace($normalized);
        }
        
        if ($this->config['trim_whitespace']) {
            $normalized = $this->trim($normalized);
        }
        
        $this->stats['whitespace_removed'] = $whitespaceBefore - strlen($normalized);
        
        // Apply line wrapping if configured
        $normalized = $this->wrapText($normalized);
        
        // Calculate statistics
        $this->calcStats($normalized);
        $this->stats['processed_length'] = strlen($normalized);
        $this->stats['processing_time'] = microtime(true) - $startTime;
        
        return $normalized;
    }
    
    public function getStatistics() {
        return $this->stats;
    }
    
    public function getConfiguration() {
        return $this->config;
    }
    
    public function configure(array $config) {
        $this->config = array_merge($this->config, $config);
    }
}
